<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Contracts\AdminInterface;

use Laravel\Sanctum\Sanctum;

class AdminContoller extends Controller implements AdminInterface
{
    /**
     * Check if the user is connected (IsAdmin)
     * @return bool
     */
    public function isAdmin()
    {
        
        if (auth('sanctum')->check()) {
            return true;
        }

        return false;
    }
}
