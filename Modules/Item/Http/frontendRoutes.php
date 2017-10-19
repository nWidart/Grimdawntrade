<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->get('my/auctions', [
    'as' => 'auction.owner',
    'uses' => 'Frontend\AuctionController@index',
]);

$router->get('auctions', [
    'as' => 'auction.index',
    'uses' => 'Frontend\AuctionController@index',
]);

$router->get('auction/new', [
    'as' => 'auction.new',
    'uses' => 'Frontend\AuctionController@create',
    'middleware' => 'logged.in',
]);
