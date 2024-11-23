<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
            'title' => 'nullable|string|max:255',
            'poster' => 'nullable|file|image|max:2048',
            'genre_ids' => 'nullable|array',
            'genre_ids.*' => 'exists:genres,id',
        ];
    }
    public function messages()
    {
        return [
            'title.max' => 'The title cannot exceed 255 characters.',
            'poster.image' => 'The poster must be a valid image file.',
            'poster.max' => 'The poster file size cannot exceed 2MB.',
            'genre_ids.*.exists' => 'One or more selected genres are invalid.',
        ];
    }
}
