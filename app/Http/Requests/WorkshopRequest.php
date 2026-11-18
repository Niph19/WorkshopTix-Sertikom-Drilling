<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class WorkshopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->roles === 'panitia';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'min:10', 'max:255'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'jadwal' => ['required', 'date'],
            'harga' => ['required', 'decimal:4,7'],
            'kuota' => ['required', 'integer', 'min:5', 'max:255'],
        ];
    }
}
