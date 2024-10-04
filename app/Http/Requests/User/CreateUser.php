<?php

namespace App\Http\Requests\User;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;
class CreateUser extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'nullable|string|in:Male,Female',
            'birth_date' => 'required|string|max:255',
            'user_type' => 'required|string|in:Admin,Therapist,Receptionist',
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required',  Rules\Password::defaults()],
            'address' => 'nullable|string|max:255',
        ]   ;
    }
}
