<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("Update Teacher");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'phone_no' => [
                'required',
                Rule::unique('users', 'phone_no')
                ->ignore($this->route()->user)
            // "user_type" => ['required', 'integer'],
            ],
        ];
    }
}
