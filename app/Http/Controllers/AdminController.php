<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Contracts\AdminInterface;

use Laravel\Sanctum\Sanctum;

class AdminController extends Controller 
{
    /**
     * Check if the user is connected (IsAdmin)
     * @return bool
     */
    static public function isAdmin(): bool
    {
        if (auth('sanctum')->check()) {
            return true;
        }
        return false;
    }
}
