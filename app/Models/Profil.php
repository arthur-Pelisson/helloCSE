<?php

namespace App\Models;

use App\Enums\StatutProfil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        "image",
        "statut",
    ];

    protected $casts = [
        'statut' => StatutProfil::class,
    ];


    /**
     * @param  $query
     * @param StatutProfil $status
     * @return void
     */
    public function scopeByStatus($query, StatutProfil $status): void
    {
         $query->where('statut', $status->value);
    }
    
}
