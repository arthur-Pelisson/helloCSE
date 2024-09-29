<?php

namespace App\Services;
use App\Models\Profil;
use App\Enums\StatutProfil;
use Illuminate\Database\Eloquent\Collection;


class ProfilService {


    /**
     * @param Profil $profil
     * @param bool $isAdmin
     * @return Collection
     */
    public function index(Profil $profil, bool $isAdmin): Collection
    {
        $role = $isAdmin ? "ADMIN" : "GUEST";
        if ($role === "ADMIN") {
            return $profil->all();
        }
        return $profil->ByStatus(StatutProfil::Actif)->get();
    }

    /**
     * @param array $validated
     * @return Profil
     */
    public function store(array $validated): Profil
    {
        return Profil::create($validated);
    }

    /**
     * @param Profil $profil
     * @return Profil
     */
    public function show(Profil $profil): Profil
    {
        return $profil;
    }

    /**
     * @param array $validated
     * @param Profil $profil
     * @return Profil|bool
     */
    public function update(array $validated, Profil $profil): Profil|bool
    {
        
        if ($profil->update($validated)) {
            return $profil;
        }
        return false;
    }

    /**
     * @param Profil $profil
     * @return bool
     */
    public function destroy(Profil $profil): bool
    {
        return $profil->delete();
    }
} 