<?php

namespace Modules\Item\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Item\Entities\Auction;
use Modules\Item\Entities\Item;
use Modules\Item\Http\Requests\CreateAuctionRequest;
use Modules\Item\Transformers\AuctionTransformer;
use Modules\User\Traits\CanFindUserWithBearerToken;

class AuctionController extends Controller
{
    use CanFindUserWithBearerToken;

    public function latest()
    {
        $auctions = Auction::orderBy('created_at', 'desc')->take(25)->get();

        return AuctionTransformer::collection($auctions);
    }

    public function search(Request $request)
    {
        $auctions = Auction::query();
        if ($name = $request->get('name')) {
            $auctions->whereHas('item', function ($query) use ($name) {
                $query->where('name', 'LIKE', "%{$name}%");
            });
        }
        if ($request->get('type_id') !== null && $rarityId = $request->get('type_id') !== 'any') {
            $typeId = $request->get('type_id');
            $auctions->whereHas('item', function ($query) use ($typeId) {
                $query->where('type_id', $typeId);
            });
        }
        if ($request->get('rarity_id') !== null && $rarityId = $request->get('rarity_id') !== 'any') {
            $rarityId = $request->get('rarity_id');
            $auctions->whereHas('item', function ($query) use ($rarityId) {
                $query->where('rarity_id', $rarityId);
            });
        }
        if ($request->get('mythical') !== 'null' && $request->get('mythical') !== null) {
            $mythical = $request->get('mythical');
            $auctions->whereHas('item', function ($query) use ($mythical) {
                $query->where('is_mythical', $mythical);
            });
        }
        if ($request->get('hardcore') !== 'null' && $request->get('hardcore') !== null) {
            $auctions->where('is_hardcore', $request->get('hardcore'));
        }
        if ($request->get('level_range')) {
            list($min, $max) = explode(',', $request->get('level_range'));
            $auctions->whereHas('item', function ($query) use ($min, $max) {
                $query->where('level', '>=', $min);
                $query->where('level', '<=', $max);
            });
        }
        $auctions->orderBy('created_at', 'desc');

        return AuctionTransformer::collection($auctions->get());
    }

    public function store(CreateAuctionRequest $request)
    {
        $item = $this->findItem($request);

        $auction = Auction::create([
            'item_id' => $item->id,
            'user_id' => $this->findUserWithBearerToken($request->header('Authorization'))->id,
            'is_hardcore' => $request->get('is_hardcore'),
        ]);

        $auction->prices()->attach($this->parseTradeForItems($request->get('trade_for')));

        return response()->json([
            'errors' => false,
            'message' => 'Auction successfully created.',
        ]);
    }

    private function findItem(Request $request)
    {
        $item = Item::find($request->get('id'));

        if ($item === null) {
            $item = Item::create($request->only([
                'name',
                'is_mythical',
                'level',
                'type_id',
                'rarity_id',
                'link',
            ]));
        }

        return $item;
    }

    private function parseTradeForItems($items)
    {
        $itemIds = [];
        foreach ($items as $itemIdOrName) {
            $item = Item::find($itemIdOrName);

            if ($item === null) {
                $item = Item::create([
                    'name' => $itemIdOrName,
                ]);
            }
            $itemIds[] = $item->id;
        }

        return $itemIds;
    }
}
