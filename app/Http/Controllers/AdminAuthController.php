<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Response\ResponseApi;
use App\Services\AdminAuthService;
use App\Contracts\AdminAuthInterface;
use App\Http\Requests\AdminAuth\LoginAdminRequest;
use App\Http\Requests\AdminAuth\RegisterAdminRequest;

class AdminAuthController extends Controller implements AdminAuthInterface
{

    /**
     * @var AdminAuthService
     */
    private $adminAuthService;

    /**
     * AdminAuthController constructor.
     * @param AdminAuthService $adminAuthService
     */
    public function __construct(AdminAuthService $adminAuthService)
    {
        $this->adminAuthService = $adminAuthService;
    }


    /**
     * Register a new admin
     * @param RegisterAdminRequest $request
     * @return JsonResponse
     */
    public function register(RegisterAdminRequest $request): JsonResponse
    {
        $newAdmin = $this->adminAuthService->register($request->validated());
        if (!$newAdmin) {
            return ResponseApi::error("An error occured", 500);
        }
        return ResponseApi::success(null, "Admin created", 201);
    }

    /**
     * Login admin
     * @param LoginAdminRequest $request
     * @return JsonResponse
     */
    public function login(LoginAdminRequest $request): JsonResponse
    {
        $adminToken = $this->adminAuthService->login($request->validated());
        if (!$adminToken) {
            return ResponseApi::error("Unauthorized", 401);
        }
        return ResponseApi::success($adminToken, "Admin logged in", 200);
    }

    /**
     * Logout admin
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $logout = $this->adminAuthService->logout($request);
        if (!$logout) {
            return ResponseApi::error("An error occured", 500);
        }
        return ResponseApi::success(null, "Admin logged out", 200);
    }
}
