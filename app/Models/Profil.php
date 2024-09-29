<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatutProfil;
class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        "image",
        "statut",
    ];


    /**
     * @param  $query
     * @param StatutProfil $status
     * @var array
     */
    public function scopeByStatus($query, StatutProfil $status): array
    {
        return $query->where('statut', $status->value);
    }
    
}
