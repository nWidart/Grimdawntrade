<?php

namespace Modules\Item\Repositories\Eloquent;

use Modules\Item\Repositories\TypeRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentTypeRepository extends EloquentBaseRepository implements TypeRepository
{
    public function all()
    {
        return $this->model->orderBy('name', 'asc')->get();
    }
}
