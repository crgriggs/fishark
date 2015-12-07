<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBreederRequest extends Request
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
           'speciesID'   => "required",
           'numFish'     => "integer|required|min:1"
        ];
    }
}
