<?php

namespace Modules\Item\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class RarityTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
        ];
    }
}
