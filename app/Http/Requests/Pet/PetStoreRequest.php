<?php

namespace App\Http\Requests\Pet;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PetStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isNotClient = Auth::user()->role != 'client';
        return [
            'name' => ['required', 'string', 'max:255'],
            'species_id' => ['required', 'integer'],
            'breed_id' => ['nullable', 'integer'],
            'age' => ['nullable', 'integer'],
            'gender' => ['nullable', 'string', 'max:255'],
            'client_id' => [Rule::requiredIf($isNotClient), 'integer'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg'],
        ];
    }
}
