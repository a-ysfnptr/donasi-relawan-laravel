<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDisbursementRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->isAdmin() ?? false; }
    public function rules(): array
    {
        return [
            'campaign_id' => ['required', 'exists:campaigns,id'],
            'amount' => ['required', 'integer', 'min:1', 'max:10000000000'],
            'recipient' => ['required', 'string', 'max:200'],
            'disbursed_at' => ['required', 'date', 'before_or_equal:today'],
            'description' => ['nullable', 'string', 'max:1000'],
            'proof_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:2048'],
        ];
    }
}
