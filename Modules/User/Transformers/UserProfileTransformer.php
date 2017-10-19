<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class UserProfileTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'display_name' => $this->display_name,
            'steam_profile_link' => $this->steam_profile_link,
            'created_at' => $this->created_at,
        ];
    }
}
