<?php

namespace Modules\Item\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Item\Transformers\RarityTransformer;

class Rarity extends Model
{
    use PresentableTrait;
    protected $presenter = RarityTransformer::class;

    protected $table = 'item__rarities';
    protected $fillable = [];
}
