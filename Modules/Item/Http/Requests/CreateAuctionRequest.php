<?php

namespace Modules\Item\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAuctionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }
}
