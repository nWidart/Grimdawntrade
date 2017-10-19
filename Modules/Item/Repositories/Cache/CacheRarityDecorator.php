<?php

namespace Modules\Item\Repositories\Cache;

use Modules\Item\Repositories\RarityRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRarityDecorator extends BaseCacheDecorator implements RarityRepository
{
    public function __construct(RarityRepository $rarity)
    {
        parent::__construct();
        $this->entityName = 'item.rarities';
        $this->repository = $rarity;
    }
}
