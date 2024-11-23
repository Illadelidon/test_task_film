<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'poster' => 'nullable',
            'genre_ids' => 'nullable|array',
            'genre_ids.*' => 'exists:genres,id',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'poster.image' => 'Poster must be an image',
            'poster.mimes' => 'Poster must be jpeg, png, jpg, or gif',
            'poster.max' => 'Poster file size must be less than 2MB',
            'genre_ids.exists' => 'Some of the genres do not exist',
        ];
    }
}
