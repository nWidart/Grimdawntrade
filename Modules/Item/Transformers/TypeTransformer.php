<?php

namespace Modules\Item\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class TypeTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
