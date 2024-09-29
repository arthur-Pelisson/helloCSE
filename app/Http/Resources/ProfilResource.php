<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;



class ProfilResource extends JsonResource
{

    public static $wrap = 'profil';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'image' => $this->image,
            'statut' => $this->statut,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];  
    }

    public static function encodeImage(string $image)
    {
        return base64_encode($image);
    }
}