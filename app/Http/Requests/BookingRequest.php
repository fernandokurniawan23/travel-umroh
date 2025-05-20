<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'number_phone' => 'required',
            // 'date' => ['required', 'date'],
            'ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'paspor' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Tambahkan validasi paspor (opsional)
            'travel_package_id' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }
}
