<?php

namespace App\Contracts;
use Illuminate\Http\Request;
interface AdminInterface
{
    public function isAdmin();
}