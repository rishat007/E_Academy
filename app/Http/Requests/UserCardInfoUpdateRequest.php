<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCardInfoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can("Update User Card Info");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card_number' => [ 'Integer', Rule::unique('users', 'phone_no')->ignore($this->route()->UserCardInfo)],
            'user_id' =>  [ 'integer'],
            'balance' =>   [ 'integer'],
            'pin_no' =>   [ 'integer'],
            'status' =>  [ 'integer']
        ];
    }
}
