<?php

namespace Modules\Item\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Sentinel\User;

class Auction extends Model
{
    protected $table = 'item__auctions';
    protected $fillable = [
        'item_id',
        'user_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
