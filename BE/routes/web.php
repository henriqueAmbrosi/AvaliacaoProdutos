<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'produtos'], function () use ($router) {
    $router->get('', ['as' => 'products.index', 'uses' => 'ProductController@index']);
    $router->get('{id}', ['as' => 'products.show', 'uses' => 'ProductController@show']);
    $router->post('', ['as' => 'products.cretae', 'uses' => 'ProductController@create']);
    $router->put('{id}', ['as' => 'products.update', 'uses' => 'ProductController@update']);
    $router->patch('{id}/ativar', ['as' => 'products.activate', 'uses' => 'ProductController@activate']);
    $router->patch('{id}/inativar', ['as' => 'products.inactivate', 'uses' => 'ProductController@inactivate']);
    $router->delete('{id}', ['as' => 'products.destroy', 'uses' => 'ProductController@destroy']);
    $router->group(['prefix' => '{product_id}/avaliacoes'], function () use ($router) {
        $router->get('', ['as' => 'ratings.index', 'uses' => 'ProductRatingController@index']);
        $router->get('{id}', ['as' => 'ratings.show', 'uses' => 'ProductRatingController@show']);
        $router->post('', ['as' => 'ratings.cretae', 'uses' => 'ProductRatingController@create']);
        $router->put('{id}', ['as' => 'ratings.update', 'uses' => 'ProductRatingController@update']);
        $router->delete('{id}', ['as' => 'ratings.destroy', 'uses' => 'ProductRatingController@destroy']);
    });
});