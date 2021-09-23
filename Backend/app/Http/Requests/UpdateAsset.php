<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateAsset extends FormRequest
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
    public function rules(Request $request)
    {
        $type = [
            'pdf', 'snippet', 'link'
        ];

        return [
            'title' => 'required|max:255|string|unique:assets,title,'.$this->id,
            'description' => 'nullable|string',
            'content' => 'required',
            'type' => ['nullable', 'string', Rule::in($type)],
            'option' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'An asset with this title already exists',
            'content.required' => 'Please select an asset.',
            'type.in' => 'Please specify a valid type of asset'
        ];
    }
}
