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
                'steam_profile_link' => $this->user->steam_profile_link,
                'display_name' => $this->user->display_name,
            ],
            'prices' => $this->prices->load(['rarity', 'type']),
        ];
    }
}
