<?php

namespace App\Contracts;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AdminAuth\LoginAdminRequest;
use App\Http\Requests\AdminAuth\RegisterAdminRequest;

interface AdminAuthInterface
{
    /**
     * Register a User
     * @param RegisterAdminRequest $request
     * @return JsonResponse
     */
    public function register(RegisterAdminRequest $request): JsonResponse;

    /**
     * Login user and create token
     * @param LoginAdminRequest $request
     * @return JsonResponse
     */
    public function login(LoginAdminRequest $request): JsonResponse;

    /**
     * Logout user (Revoke the token)
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request) : JsonResponse;
}
