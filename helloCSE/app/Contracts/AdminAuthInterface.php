<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface AdminAuthInterface
{
    public function register(Request $request);

    public function login(Request $request);

    public function logout(Request $request);
}
