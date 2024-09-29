<?php

namespace App\Enums;

enum StatutProfil: string
{
    case ACTIF = 'actif';
    case INACTIF = 'inactif';
    case EN_ATTENTE = 'en attente';
}