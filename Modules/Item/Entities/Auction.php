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
        'is_hardcore',
    ];
    protected $casts = [
        'is_hardcore' => 'bool',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prices()
    {
        return $this->belongsToMany(Item::class, 'item__prices');
    }
}
