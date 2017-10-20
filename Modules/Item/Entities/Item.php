<?php

namespace Modules\Item\Entities;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item__items';
    protected $fillable = [
        'name',
        'is_mythical',
        'level',
        'type_id',
        'rarity_id',
        'link',
    ];
    protected $casts = [
        'is_mythical' => 'bool',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function rarity()
    {
        return $this->belongsTo(Rarity::class);
    }
}
