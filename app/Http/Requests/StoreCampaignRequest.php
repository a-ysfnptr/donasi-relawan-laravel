<?php

namespace App\Http\Requests;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCampaignRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->isAdmin() ?? false; }
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:200'],
            'category' => ['required', Rule::in(Campaign::CATEGORIES)],
            'description' => ['required', 'string', 'max:5000'],
            'target_amount' => ['required', 'integer', 'min:1000', 'max:10000000000'],
            'deadline' => ['required', 'date', 'after_or_equal:today'],
            'status' => ['required', Rule::in(Campaign::STATUSES)],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Judul kampanye wajib diisi.',
            'target_amount.min' => 'Target dana minimal Rp1.000.',
            'cover_image.image' => 'Foto sampul harus berupa gambar (jpg/png/webp, maks 2 MB).',
        ];
    }
}
