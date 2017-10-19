<?php

namespace Modules\Item\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Modules\Item\Repositories\RarityRepository;
use Modules\Item\Transformers\RarityTransformer;

class RarityController extends Controller
{
    /**
     * @var RarityRepository
     */
    private $rarity;

    public function __construct(RarityRepository $rarity)
    {
        $this->rarity = $rarity;
    }

    public function index()
    {
        return RarityTransformer::collection($this->rarity->all());
    }
}
