<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("Create Student Class");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', Rule::unique('roles', 'name')],
            'permissions' => ['required', 'array'],
            "pemissions.*" => ['string'],
            "guard_name" => ['required', 'string'],
        ];
    }

    public function prepareforvalidation(){
        $this->merge([
            'guard_name' => 'web',
        ]);
    }
}
