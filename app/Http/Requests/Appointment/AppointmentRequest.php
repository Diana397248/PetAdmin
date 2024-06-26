<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AppointmentRequest extends FormRequest
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
            'client_id' => [Rule::requiredIf($isNotClient), 'integer', 'exists:clients,id'],
            'vet_id' => 'required|integer|exists:vets,id',
            'description' => 'nullable|string',
            'start_time' => 'required|date|after:today',
        ];
    }
}
