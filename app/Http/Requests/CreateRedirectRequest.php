<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateRedirectRequest extends Request
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
            'long_url' => 'required|url',
            'short_url' => 'required|min:2|unique:redirect_rules,short_url',
        ];
    }
}
