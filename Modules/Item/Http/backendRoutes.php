<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/item'], function (Router $router) {
    $router->bind('rarity', function ($id) {
        return app('Modules\Item\Repositories\RarityRepository')->find($id);
    });
    $router->get('rarities', [
        'as' => 'admin.item.rarity.index',
        'uses' => 'RarityController@index',
        'middleware' => 'can:item.rarities.index'
    ]);
    $router->get('rarities/create', [
        'as' => 'admin.item.rarity.create',
        'uses' => 'RarityController@create',
        'middleware' => 'can:item.rarities.create'
    ]);
    $router->post('rarities', [
        'as' => 'admin.item.rarity.store',
        'uses' => 'RarityController@store',
        'middleware' => 'can:item.rarities.create'
    ]);
    $router->get('rarities/{rarity}/edit', [
        'as' => 'admin.item.rarity.edit',
        'uses' => 'RarityController@edit',
        'middleware' => 'can:item.rarities.edit'
    ]);
    $router->put('rarities/{rarity}', [
        'as' => 'admin.item.rarity.update',
        'uses' => 'RarityController@update',
        'middleware' => 'can:item.rarities.edit'
    ]);
    $router->delete('rarities/{rarity}', [
        'as' => 'admin.item.rarity.destroy',
        'uses' => 'RarityController@destroy',
        'middleware' => 'can:item.rarities.destroy'
    ]);
    $router->bind('type', function ($id) {
        return app('Modules\Item\Repositories\TypeRepository')->find($id);
    });
    $router->get('types', [
        'as' => 'admin.item.type.index',
        'uses' => 'TypeController@index',
        'middleware' => 'can:item.types.index'
    ]);
    $router->get('types/create', [
        'as' => 'admin.item.type.create',
        'uses' => 'TypeController@create',
        'middleware' => 'can:item.types.create'
    ]);
    $router->post('types', [
        'as' => 'admin.item.type.store',
        'uses' => 'TypeController@store',
        'middleware' => 'can:item.types.create'
    ]);
    $router->get('types/{type}/edit', [
        'as' => 'admin.item.type.edit',
        'uses' => 'TypeController@edit',
        'middleware' => 'can:item.types.edit'
    ]);
    $router->put('types/{type}', [
        'as' => 'admin.item.type.update',
        'uses' => 'TypeController@update',
        'middleware' => 'can:item.types.edit'
    ]);
    $router->delete('types/{type}', [
        'as' => 'admin.item.type.destroy',
        'uses' => 'TypeController@destroy',
        'middleware' => 'can:item.types.destroy'
    ]);
    $router->bind('item', function ($id) {
        return app('Modules\Item\Repositories\ItemRepository')->find($id);
    });
    $router->get('items', [
        'as' => 'admin.item.item.index',
        'uses' => 'ItemController@index',
        'middleware' => 'can:item.items.index'
    ]);
    $router->get('items/create', [
        'as' => 'admin.item.item.create',
        'uses' => 'ItemController@create',
        'middleware' => 'can:item.items.create'
    ]);
    $router->post('items', [
        'as' => 'admin.item.item.store',
        'uses' => 'ItemController@store',
        'middleware' => 'can:item.items.create'
    ]);
    $router->get('items/{item}/edit', [
        'as' => 'admin.item.item.edit',
        'uses' => 'ItemController@edit',
        'middleware' => 'can:item.items.edit'
    ]);
    $router->put('items/{item}', [
        'as' => 'admin.item.item.update',
        'uses' => 'ItemController@update',
        'middleware' => 'can:item.items.edit'
    ]);
    $router->delete('items/{item}', [
        'as' => 'admin.item.item.destroy',
        'uses' => 'ItemController@destroy',
        'middleware' => 'can:item.items.destroy'
    ]);
// append



});
