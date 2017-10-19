<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Contracts\Authentication;
use Modules\User\Traits\CanFindUserWithBearerToken;

class UpdatePublicProfileRequest extends FormRequest
{
    use CanFindUserWithBearerToken;

    public function rules()
    {
        return [
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
