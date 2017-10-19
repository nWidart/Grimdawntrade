<?php

namespace Modules\Item\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class AuctionTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'time_ago' => $this->created_at->diffForHumans(),
            'item' => new ItemTransformer($this->item),
            'user' => [
                'id' => $this->user->id,
                'steam_profile' => $this->user->steam_profile,
            ],
            'prices' => $this->prices->load(['rarity', 'type']),
        ];
    }
}
