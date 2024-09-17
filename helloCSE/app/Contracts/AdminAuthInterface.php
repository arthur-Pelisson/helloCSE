<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface AdminAuthInterface
{
    /**
     * Register a new user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request);

    /**
     * Login user and create token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request);

    /**
     * Logout user (Revoke the token)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function logout(Request $request);
}
