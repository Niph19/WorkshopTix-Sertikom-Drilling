<?php

namespace App\Http\Requests;

use App\Models\Registration;
use App\Models\Workshop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->roles === 'peserta';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'workshop_id' => [
                'bail',
                'required',
                'integer',
                Rule::exists('workshops', 'id'),
            ],
            'jumlah' => [
                'bail',
                'required',
                'integer',
                'min:1',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    $workshop = Workshop::query()->find($this->input('workshop_id'));

                    if (!$workshop) {
                        return;
                    }

                    $registeredSeats = Registration::query()
                        ->where('workshop_id', $workshop->id)
                        ->whereIn('status', ['menunggu', 'lunas'])
                        ->sum('jumlah');

                    if ($registeredSeats + $value > $workshop->kuota) {
                        $fail('Jumlah tiket melebihi kuota workshop yang tersisa.');
                    }
                },
            ],
        ];
    }
}
