<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletStoreRequest extends FormRequest
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
            'exam_type'=> ['required', 'integer'],
            'exam_fee'=> ['required', 'integer'],
            'card_number'=> ['required', 'integer'],
            'paid'=> ['required'],
            'discount'=> ['nullable'],

        ];
    }
    public function messages()
    {
        return  [
            'card_number.required'=>'Please enter card number',
            'card_number.integer'=>'card number must be a number',
        ];
    }

}
