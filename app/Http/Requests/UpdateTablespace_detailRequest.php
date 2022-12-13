<?php

namespace App\Http\Requests;

use App\Models\Tablespace_detail;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTablespace_detailRequest extends FormRequest
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
        $rules = Tablespace_detail::$rules;

        return $rules;
    }
}