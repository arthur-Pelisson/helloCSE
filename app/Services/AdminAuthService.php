<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;

class AdminAuthService
{

    /**
     * @param array $validated
     * @return Administrateur
     */
    public function register(array $validated): Administrateur
    {
        return Administrateur::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($validated['password']),
        ]);;
    }

    /**
     * @param array $validated
     * @return string|bool
     */
    public function login(array $validated): string|bool
    {
        $admin = Administrateur::where('email', $validated['email'])->first();
        if (!$admin || !Hash::check($validated['password'], $admin->password)) {
            return false;
        }
        $token = $admin->createToken('admin_token')->plainTextToken;
        return $token;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function logout(Request $request): bool
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
