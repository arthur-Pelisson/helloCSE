<?php

namespace App\Contracts;

use Illuminate\Http\Request;
use App\Http\Requests\StoreprofilRequest;
use App\Http\Requests\UpdateprofilRequest;
use App\Models\profil;

interface ProfileInterface
{
    public function index();

    public function store(StoreprofilRequest $request);

    public function show(profil $id);

    public function update(UpdateprofilRequest $request, profil $profil);

    public function destroy(profil $profil);
}