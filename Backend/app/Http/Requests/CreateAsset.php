<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAsset extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $type = [
            'pdf', 'snippet', 'link'
        ];

        return [
            'title' => 'required|max:255|string|unique:assets',
            'description' => 'nullable|string',
            'content' => 'required',
            'type' => ['nullable', 'string', Rule::in($type)],
            'option' => 'nullable|boolean'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Please select an asset.',
            'type.in' => 'Please specify a valid type of asset'
        ];
    }
}
