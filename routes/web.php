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
	$app->get('category','ApiController@category');
	$app->get('info/{id}', 'ApiController@article');
	$app->get('noticeDetail/{id}', 'ApiController@noticeDetail');
	$app->get('login','ApiController@login');
	$app->get('space/{id}','ApiController@space');
});