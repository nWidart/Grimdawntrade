<?php

namespace Modules\Item\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;

class AuctionController extends Controller
{
    public function index()
    {
        return view('item::public.auction.index');
    }

    public function create()
    {
        return view('item::public.auction.create');
    }
}
