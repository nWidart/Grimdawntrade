<?php

namespace Modules\Item\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Modules\Item\Repositories\TypeRepository;
use Modules\Item\Transformers\TypeTransformer;

class TypeController extends Controller
{
    /**
     * @var TypeRepository
     */
    private $type;

    public function __construct(TypeRepository $type)
    {
        $this->type = $type;
    }

    public function index()
    {
        return TypeTransformer::collection($this->type->all());
    }
}
