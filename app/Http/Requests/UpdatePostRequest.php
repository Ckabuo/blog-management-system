<?php

namespace App\Http\Requests;

use App\Enums\PostType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'slug' => ['sometimes','string','max:255', new Enum(PostType::class)],
            'content' => 'sometimes|string',
            'image_url' => 'sometimes|string',
        ];
    }
}
