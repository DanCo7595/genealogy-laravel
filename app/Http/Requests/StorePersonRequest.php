<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
{
    public function authorize()
    {
        // Cette méthode détermine si l'utilisateur est autorisé à effectuer la requête.
        // On retourne true pour autoriser tous les utilisateurs authentifiés.
        return auth()->check();
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'middle_names' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date_format:Y-m-d',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'first_name' => ucfirst(strtolower($this->first_name)),
            'middle_names' => $this->formatMiddleNames($this->middle_names),
            'last_name' => strtoupper($this->last_name),
            'birth_name' => strtoupper($this->birth_name ?? $this->last_name),
            'date_of_birth' => $this->date_of_birth ?: null,
        ]);
    }

    private function formatMiddleNames($middleNames)
    {
        if ($middleNames) {
            $names = explode(',', $middleNames);
            $formattedNames = array_map(function($name) {
                return ucfirst(strtolower(trim($name)));
            }, $names);

            return implode(',', $formattedNames);
        }

        return null;
    }
}
