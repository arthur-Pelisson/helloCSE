<?php

namespace App\Policies;

use App\Models\administrateur;
use App\Models\profil;
use Illuminate\Auth\Access\Response;

class ProfilPolicy
{
    /**
     * Determine whether the Administrateur can view any models.
     */
    public function viewAny(administrateur $administrateur): bool
    {
        //
    }

    /**
     * Determine whether the Administrateur can view the model.
     */
    public function view(administrateur $administrateur, profil $profil): bool
    {
        //
    }

    /**
     * Determine whether the Administrateur can create models.
     */
    public function create(administrateur $administrateur): bool
    {
        //
    }

    /**
     * Determine whether the Administrateur can update the model.
     */
    public function update(administrateur $administrateur, profil $profil): bool
    {
        //
    }

    /**
     * Determine whether the Administrateur can delete the model.
     */
    public function delete(administrateur $administrateur, profil $profil): bool
    {
        //
    }

    /**
     * Determine whether the Administrateur can restore the model.
     */
    public function restore(administrateur $administrateur, profil $profil): bool
    {
        //
    }

    /**
     * Determine whether the Administrateur can permanently delete the model.
     */
    public function forceDelete(administrateur $administrateur, profil $profil): bool
    {
        //
    }
}
