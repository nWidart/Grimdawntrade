<?php

namespace Modules\Item\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ItemTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_mythical' => $this->is_mythical,
            'level' => $this->level,
            'type_id' => optional($this->type)->id,
            'rarity_id' => optional($this->rarity)->id,
            'rarity' => new RarityTransformer($this->rarity),
            'type' => new TypeTransformer($this->type),
        ];
    }
}
