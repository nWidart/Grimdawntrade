<?php

namespace Modules\Item\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Item\Entities\Rarity;
use Modules\Item\Http\Requests\CreateRarityRequest;
use Modules\Item\Http\Requests\UpdateRarityRequest;
use Modules\Item\Repositories\RarityRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class RarityController extends AdminBaseController
{
    /**
     * @var RarityRepository
     */
    private $rarity;

    public function __construct(RarityRepository $rarity)
    {
        parent::__construct();

        $this->rarity = $rarity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$rarities = $this->rarity->all();

        return view('item::admin.rarities.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('item::admin.rarities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRarityRequest $request
     * @return Response
     */
    public function store(CreateRarityRequest $request)
    {
        $this->rarity->create($request->all());

        return redirect()->route('admin.item.rarity.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('item::rarities.title.rarities')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Rarity $rarity
     * @return Response
     */
    public function edit(Rarity $rarity)
    {
        return view('item::admin.rarities.edit', compact('rarity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Rarity $rarity
     * @param  UpdateRarityRequest $request
     * @return Response
     */
    public function update(Rarity $rarity, UpdateRarityRequest $request)
    {
        $this->rarity->update($rarity, $request->all());

        return redirect()->route('admin.item.rarity.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('item::rarities.title.rarities')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Rarity $rarity
     * @return Response
     */
    public function destroy(Rarity $rarity)
    {
        $this->rarity->destroy($rarity);

        return redirect()->route('admin.item.rarity.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('item::rarities.title.rarities')]));
    }
}
