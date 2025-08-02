<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
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
            'slug' => 'nullable|string',
            'category' => 'nullable|string',
            'duration' => 'required|integer',
            'created_in' => 'required|date',
            'poster_url' => 'nullable|string',
            'locality_id' => 'required|exists:localities,id',
            'bookable' => 'boolean',
            'description' => 'nullable|string',
        ];
    }
}
