<?php

namespace App\Services;

use App\Models\Profil;
use App\Enums\StatutProfil;
use App\Redis\CacheService;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\AdminController;
class ProfilService
{

    private CacheService $cacheService;
    public string $cacheKey = 'profil';
    private string $role;

    public function __construct(CacheService $cacheService, AdminController $adminController)
    {
        $this->cacheService = $cacheService;
        $this->role = $adminController::isAdmin() ? "ADMIN" : "USER";
    }

    
    /**
     * @param Profil $profil
     * @param bool $isAdmin
     * @return Collection
     */

    public function index(Profil $profil): Collection
    {
        $cacheKey = "{$this->cacheKey}-getAll-{$this->role}";

        if ($this->cacheService->exists($cacheKey)) {
            return $this->cacheService->get($cacheKey);
        }
       
        if ($this->role === "ADMIN") {
            $profils = $profil->all(); 
        } else {
            $profils = $profil->ByStatus(StatutProfil::ACTIF)->get();
        }
        
        $this->cacheService->store($cacheKey, $profils);

        return $profils; 
    }

    /**
     * @param array $validated
     * @return Profil
     */
    public function store(array $validated): Profil
    {
        $newProfil = Profil::create($validated);
        if ($newProfil) {
            $this->cacheService->delete($this->cacheKey."-getAll-".$this->role);
        }
        return Profil::create($validated);
    }

    /**
     * @param Profil $profil
     * @return Profil
     */
    public function show(Profil $profil): Profil
    {
        if ($this->cacheService->exists($this->cacheKey."-".$profil->id)) {
            return $this->cacheService->get($this->cacheKey."-".$profil->id);
        }
        $this->cacheService->store($this->cacheKey."-".$profil->id, $profil);
        return $profil;
    }

    /**
     * @param array $validated
     * @param Profil $profil
     * @return Profil|bool
     */
    public function update(array $validated, Profil $profil): Profil|bool
    {

        if ($profil->update($validated)) {
            $this->cacheService->delete($this->cacheKey."-".$profil->id);
            return $profil;
        }
        return false;
    }

    /**
     * @param Profil $profil
     * @return bool
     */
    public function destroy(Profil $profil): bool
    {
        $this->cacheService->delete($this->cacheKey."-".$profil->id);
        return $profil->delete();
    }
}
