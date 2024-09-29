<?php

namespace App\Http\Controllers;



use App\Models\Profil;
use Illuminate\Http\Request;
use App\Services\ProfilService;
use Illuminate\Http\JsonResponse;
use App\Http\Response\ResponseApi;
use App\Contracts\ProfileInterface;
use App\Http\Resources\ProfilResource;
use App\Http\Controllers\AdminController;
use App\Http\Resources\ProfilCollection;
use App\Http\Requests\profil\StoreprofilRequest;
use App\Http\Requests\profil\UpdateprofilRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProfilController extends Controller implements ProfileInterface
{
    use AuthorizesRequests;

    private $profilService;
    private $isAdmin;
    private $profilCollection;

    /**
     * @param ProfilService $profilService
     * @param AdminController $adminController
     * @param ProfilCollection $profilCollection
     */
    public function __construct(ProfilService $profilService, AdminController $adminController)
    {
        $this->profilService = $profilService;
        $this->isAdmin = $adminController::isAdmin();
    }

    /**
     * Display a listing of the resource by role.
     *
     * @param Profil $profil
     * @return  JsonResponse
     */
    public function index(Request $request, Profil $profil): JsonResponse
    {
        $profils = $this->profilService->index($profil, $this->isAdmin);
        return ResponseApi::success(new ProfilCollection($profils), "Profils found", 200);
    }

    /**
     * Store a newly created profil resource in storage.
     * @param StoreprofilRequest $request
     * @return JsonResponse
     */
    public function store(StoreprofilRequest $request): JsonResponse
    {
        $newProfil = $this->profilService->store($request->validated());
        if (!$newProfil) {
            return ResponseApi::error("An error occured", 500);
        }
        return ResponseApi::success(new ProfilResource($newProfil), "Profile created", 201);
    }

    /**
     * Display unique profil resource.
     *
     * @param profil $profil
     * @return JsonResponse
     */
    public function show(Profil $profil): JsonResponse
    {
        $profil = $this->profilService->show($profil);
        if (!$profil) {
            return ResponseApi::error("Profile not found", 404);
        }
        return ResponseApi::success(new ProfilResource($profil), "Profile found", 200);
    }

    /**
     * Update the profil resource in storage.
     *
     * @param UpdateprofilRequest $request
     * @param profil $profil
     * @return JsonResponse
     */
    public function update(UpdateprofilRequest $request, profil $profil): JsonResponse
    {
        $profil = $this->profilService->update($request->validated(), $profil);
        if (!$profil) {
            return ResponseApi::error("An error occured", 500);
        }
        return ResponseApi::success(new ProfilResource($profil), "Profile updated", 200);
    }

    /**
     * Remove the profil resource from storage.
     *
     * @param profil $profil
     * @return JsonResponse
     */
    public function destroy(Profil $profil): JsonResponse
    {
        $profil = $this->profilService->destroy($profil);
        if (!$profil) {
            return ResponseApi::error("An error occured", 500);
        }
        return ResponseApi::success(null, "Profile deleted", 200);
    }
}
