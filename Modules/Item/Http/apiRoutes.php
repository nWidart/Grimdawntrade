<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->get('items/search', [
    'as' => 'api.item.item.search',
    'uses' => 'ItemController@search',
]);
$router->get('items/{item}', [
    'as' => 'api.item.item.find',
    'uses' => 'ItemController@find',
]);
$router->get('auction/latest', [
    'as' => 'api.item.auction.latest',
    'uses' => 'AuctionController@latest',
]);
$router->get('auction/search', [
    'as' => 'api.item.auction.search',
    'uses' => 'AuctionController@search',
]);
$router->post('auction/store', [
    'as' => 'api.item.auction.store',
    'uses' => 'AuctionController@store',
]);

$router->get('my/auctions', [
    'as' => 'api.item.my.auctions.index',
    'uses' => 'MyAuctionController@index',
]);
$router->get('my/auctions/search', [
    'as' => 'api.item.my.auctions.search',
    'uses' => 'MyAuctionController@search',
]);
$router->delete('my/auctions/{auction}', [
    'as' => 'api.item.my.auctions.delete',
    'uses' => 'MyAuctionController@delete',
]);

$router->get('types', [
    'as' => 'api.item.type.index',
    'uses' => 'TypeController@index',
]);

$router->get('rarities', [
    'as' => 'api.item.rarity.index',
    'uses' => 'RarityController@index',
]);
