<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVolunteerRequest extends FormRequest
{
    public function authorize(): bool { return (bool) $this->user(); }
    public function rules(): array
    {
        return [
            'campaign_id' => ['required', 'exists:campaigns,id'],
            'skill' => ['required', 'string', 'max:100'],
            'availability' => ['required', 'string', 'max:100'],
            'motivation' => ['nullable', 'string', 'max:500'],
        ];
    }
}
