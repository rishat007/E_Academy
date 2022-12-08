<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCardInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("Create User Card Info");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                    'card_number' => ['required', 'Integer', Rule::unique('users', 'phone_no')],
                    'user_id' =>  ['required', 'integer'],
                    'balance' =>   ['required', 'integer'],
                    'pin_no' =>   ['required', 'integer'],
                    'status' =>  ['required', 'integer']
                ];
    }
}
