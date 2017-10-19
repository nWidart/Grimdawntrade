<?php

namespace Modules\Item\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Item\Entities\Auction;
use Modules\Item\Entities\Item;
use Modules\Item\Http\Requests\CreateAuctionRequest;
use Modules\Item\Transformers\AuctionTransformer;
use Modules\User\Traits\CanFindUserWithBearerToken;

class MyAuctionController extends Controller
{
    use CanFindUserWithBearerToken;

    public function index(Request $request)
    {
        $auctions = Auction::orderBy('created_at', 'desc')
            ->where('user_id', $this->findUserWithBearerToken($request->header('Authorization'))->id)
            ->get();

        return AuctionTransformer::collection($auctions);
    }

    public function search(Request $request)
    {
        $auctions = Auction::where('user_id', $this->findUserWithBearerToken($request->header('Authorization'))->id);

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
        if ($request->get('level_range')) {
            list($min, $max) = explode(',', $request->get('level_range'));
            $auctions->whereHas('item', function ($query) use ($min, $max) {
                $query->where('level', '>=', $min);
                $query->where('level', '<=', $max);
            });
        }

        return AuctionTransformer::collection($auctions->get());
    }

    public function delete(Auction $auction)
    {
        $auction->delete();

        return response()->json([
            'errors' => false,
            'message' => 'Auction successfully deleted.',
        ]);
    }
}
