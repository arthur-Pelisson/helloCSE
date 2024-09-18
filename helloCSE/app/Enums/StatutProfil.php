<?php

namespace App\Enums;

enum StatutProfil: string
{
    case Actif = 'actif';
    case Inactif = 'inactif';
    case EnAttente = 'en attente';
}