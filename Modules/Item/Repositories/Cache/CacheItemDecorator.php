<?php

namespace Modules\Item\Repositories\Cache;

use Modules\Item\Repositories\ItemRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheItemDecorator extends BaseCacheDecorator implements ItemRepository
{
    public function __construct(ItemRepository $item)
    {
        parent::__construct();
        $this->entityName = 'item.items';
        $this->repository = $item;
    }
}
