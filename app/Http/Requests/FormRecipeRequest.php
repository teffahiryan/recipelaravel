<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FormRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * On le passe a true si on veut que les utilisateurs puissent utiliser cette requête
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * On ajoute ici les règles qu'on veut aux inputs qu'on veut
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // Règle :  requis, et 8 caractères minimum
            'name' => ['required', 'min:8'],
            // Règle :  *, Regex qui autorise les lettres, nombres et tirets plusieurs fois, REVOIR LA REGLE UNIQUE -> Grafikart - Laravel 10 les formulaires
            'slug' => ['required', 'min:8', 'regex:/^[0-9a-z\-]+$/', Rule::unique('recipes')->ignore($this->route()->parameter('recipe'))],
            'step' => ['required']
        ];
    }

    // Préparation des données avant la validation au dessus
    protected function prepareForValidation()
    {
        $this->merge([
            // Récupère l'input slug, s'il n'existe pas alors on le créer via le name
            'slug' => $this->input('slug') ?: Str::slug($this->input('name'))
        ]);
    }
}
