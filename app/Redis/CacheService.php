<?php

namespace App\Redis;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CacheService
{
    protected $cacheKeyPrefix = 'app_cache:';

    /**
     * Check if Redis is available.
     * @param callable $callBack
     * @return bool
     */
    public function redisAvailable(callable $callBack): mixed
    {
        if (Cache::connection()->client()->isConnected()) {
            return $callBack();
        } 
        return false; 
    }

    /**
     * Store data in Redis.
     *
     * @param string $key
     * @param mixed $value
     * @param int $ttl
     * @return bool
     */
    public function store($key, $value, $ttl = 3600): bool
    {
        return $this->redisAvailable(function() use ($key, $value, $ttl) {
            $cacheKey = $this->cacheKeyPrefix . $key;
            return Cache::put($cacheKey, $value, $ttl);
        });
    }

    /**
     * Retrieve data from Redis.
     *
     * @param string $key
     * @return mixed
     */
    public function get($key): mixed
    {
       return $this->redisAvailable(function() use ($key) {
            $cacheKey = $this->cacheKeyPrefix . $key;
            return Cache::get($cacheKey);
        });
    }

    /**
     * Remove data from Redis.
     *
     * @param string $key
     * @return bool
     */
    public function delete($key): bool
    {
        return $this->redisAvailable(function() use ($key) {
            $cacheKey = $this->cacheKeyPrefix . $key;
            return Cache::forget($cacheKey);
        });
    }

    /**
     * Check if a cache key exists.
     *
     * @param string $key
     * @return bool
     */
    public function exists($key): bool
    {
        return $this->redisAvailable(function() use ($key) {
            $cacheKey = $this->cacheKeyPrefix . $key;
            return Cache::has($cacheKey);
        });
    }
}
