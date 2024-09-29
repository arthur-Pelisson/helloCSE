<?php

namespace App\Contracts;
interface AdminInterface
{
    /**
     * Check if the user is connected (IsAdmin)
     * @return bool
     */
    public function isAdmin():bool;
}