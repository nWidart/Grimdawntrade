<?php

namespace Modules\Item\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Item\Entities\Type;
use Modules\Item\Http\Requests\CreateTypeRequest;
use Modules\Item\Http\Requests\UpdateTypeRequest;
use Modules\Item\Repositories\TypeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class TypeController extends AdminBaseController
{
    /**
     * @var TypeRepository
     */
    private $type;

    public function __construct(TypeRepository $type)
    {
        parent::__construct();

        $this->type = $type;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$types = $this->type->all();

        return view('item::admin.types.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('item::admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTypeRequest $request
     * @return Response
     */
    public function store(CreateTypeRequest $request)
    {
        $this->type->create($request->all());

        return redirect()->route('admin.item.type.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('item::types.title.types')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Type $type
     * @return Response
     */
    public function edit(Type $type)
    {
        return view('item::admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Type $type
     * @param  UpdateTypeRequest $request
     * @return Response
     */
    public function update(Type $type, UpdateTypeRequest $request)
    {
        $this->type->update($type, $request->all());

        return redirect()->route('admin.item.type.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('item::types.title.types')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Type $type
     * @return Response
     */
    public function destroy(Type $type)
    {
        $this->type->destroy($type);

        return redirect()->route('admin.item.type.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('item::types.title.types')]));
    }
}
