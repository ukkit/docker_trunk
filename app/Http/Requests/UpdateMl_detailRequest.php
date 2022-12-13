<?php

namespace App\Http\Requests;

use App\Models\Ml_detail;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMl_detailRequest extends FormRequest
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
        $rules = Ml_detail::$rules;

        return $rules;
    }
}
