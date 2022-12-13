<?php

namespace App\Http\Requests;

use App\Models\Product_version;
use Illuminate\Foundation\Http\FormRequest;

class CreateProduct_versionRequest extends FormRequest
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
        return Product_version::$rules;
    }
}
