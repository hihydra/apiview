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

$app->group(['prefix' => 'open/apply/{school}','middleware' => ['api']], function ($app){
	$app->get('index','ApiController@index');
	$app->get('recipe/{id}', 'ApiController@recipe');
	$app->get('teacherIntro/{id}', 'ApiController@profiles');
	$app->get('{cate}','ApiController@list');
});

$app->get('/open/info/{id}', 'ApiController@article');
$app->get('/open/noticeDetail/{id}', 'ApiController@noticeDetail');
/*
$app->group(['prefix' => 'open/school/{school}','middleware' => ['api']], function ($app){
	$app->get('index/{cate}', 'ApiController@photo');
	$app->get('{cate}','ApiController@list');
});
*/