<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProfilCollection extends ResourceCollection
{

    public static $wrap = '';

    public function toArray(Request $request): array
    {
        return [
           "profils"=> $this->collection
        ];
    }
}