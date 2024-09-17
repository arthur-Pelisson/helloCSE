<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Contracts\AdminInterface;
use Illuminate\Http\Request;
class AdminContoller extends Controller implements AdminInterface
{
    /**
     * Check if the user is connected (IsAdmin)
     * @return bool
     */
    public function isAdmin()
    {
        if (Auth::check()) {
            return true;
        }

        return false;
    }
}
