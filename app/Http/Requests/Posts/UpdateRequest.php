<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255',
            'picture' => 'nullable|image|max:10240',
            'content' => 'required|string',
            'status' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('validation.attributes.post.title'),
            'picture' => __('validation.attributes.post.picture'),
            'content' => __('validation.attributes.post.content'),
            'status' => __('validation.attributes.post.status'),
        ];
    }
}
