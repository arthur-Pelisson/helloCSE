<?php

namespace App\Http\Requests\profil;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\StatutProfil;
use Illuminate\Validation\Rule;

class UpdateprofilRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'image' => 'required|string',
            'statut' => ['required', Rule::in([StatutProfil::Actif, StatutProfil::Inactif, StatutProfil::EnAttente])],
        ];
    }
}
