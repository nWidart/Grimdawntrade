<?php

namespace Modules\Item\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Item\Entities\Item;
use Modules\Item\Repositories\ItemRepository;
use Modules\Item\Transformers\ItemTransformer;

class ItemController extends Controller
{
    /**
     * @var ItemRepository
     */
    private $item;

    public function __construct(ItemRepository $item)
    {
        $this->item = $item;
    }

    public function search(Request $request)
    {
        $items = Item::where('name', 'LIKE', "%{$request->get('query')}%")->get();

        return ItemTransformer::collection($items);
    }

    public function find(Item $item)
    {
        return new ItemTransformer($item);
    }
}
