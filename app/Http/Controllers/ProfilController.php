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

/**
 * @var ProfilService $profilService
 * @var bool $isAdmin
 * @var ProfilCollection $profilCollection
 * @method bool isAdmin()
 * @method JsonResponse index(Request $request, Profil $profil)
 * @method JsonResponse store(StoreprofilRequest $request)
 * @method JsonResponse show(Profil $profil)
 * @method JsonResponse update(UpdateprofilRequest $request, Profil $profil)
 * @method JsonResponse destroy(Profil $profil)
 * @
 */
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
     * @param Request $request
     * @response array{message: string, success: bool, data: array{Profils : array{nom: string, prenom: string, email: string, statut: string, created_at: string, updated_at: string}}}
     * @return  JsonResponse
     */
    public function index(Request $request, Profil $profil): JsonResponse
    {
        $profils = $this->profilService->index($profil);
        return ResponseApi::success(new ProfilCollection($profils), "Profils found", 200);
    }

    /**
     * Store a newly created profil resource in storage.
     * @param StoreprofilRequest $request
     * @response array{message: string, success: bool, data: array{nom: string, prenom: string, email: string, statut: string, created_at: string, updated_at: string}}
     * @return JsonResponse
     * 
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
     * @response array{message: string, success: bool, data: array{nom: string, prenom: string, email: string, statut: string, created_at: string, updated_at: string}}
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
     * @response array{message: string, success: bool, data: array{nom: string, prenom: string, email: string, statut: string, created_at: string, updated_at: string}}
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
     * @response array{message: string, success: bool, data: null}
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
