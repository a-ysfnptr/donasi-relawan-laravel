<?php

namespace App\Http\Requests;

use App\Models\Donation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDonationRequest extends FormRequest
{
    public function authorize(): bool { return (bool) $this->user(); }
    public function rules(): array
    {
        return [
            'campaign_id' => ['required', 'exists:campaigns,id'],
            'amount' => ['required', 'integer', 'min:1000', 'max:1000000000'],
            'method' => ['required', Rule::in(Donation::METHODS)],
            'message' => ['nullable', 'string', 'max:500'],
            'is_anonymous' => ['nullable', 'boolean'],
            'proof_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:2048'],
        ];
    }
    public function messages(): array
    {
        return ['amount.min' => 'Nominal donasi minimal Rp1.000.', 'proof_file.mimes' => 'Bukti transfer harus gambar atau PDF (maks 2 MB).'];
    }
}
