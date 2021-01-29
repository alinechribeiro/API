<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| The application is composed by two endpoints.
|
| Both endpoints call the same methods on getSearchRequest defined on the
| class SearchController.
|
 */
$router->group(['prefix'                      => '/'], function () use ($router) {
		$router->post('getCustomerRequest', ['uses' => 'SearchController@getSearchRequest']);
		$router->post('getProductRequest', ['uses'  => 'SearchController@getSearchRequest']);
	});