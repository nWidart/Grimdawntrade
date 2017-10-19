<?php

namespace Modules\Item\Repositories\Cache;

use Modules\Item\Repositories\TypeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTypeDecorator extends BaseCacheDecorator implements TypeRepository
{
    public function __construct(TypeRepository $type)
    {
        parent::__construct();
        $this->entityName = 'item.types';
        $this->repository = $type;
    }
}
