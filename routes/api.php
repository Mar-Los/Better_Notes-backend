<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [
    'as' => 'login',
    'uses' => 'Api\Auth\LoginController@login'
]);

Route::post('/register', 'Api\Auth\LoginController@register');


Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user()->only(['id', 'email']);
    });

    Route::get('/folders/root', 'Api\FolderController@getRootFolders');
    Route::post('/folders/root', 'Api\FolderController@createRootFolder');
    Route::resource('folders', 'Api\FolderController')->except(['create', 'edit']);

    Route::get('folderfiles/{id}', 'Api\FileController@showFolderFiles');
    Route::resource('files', 'Api\FileController')->except(['create', 'edit']);

    Route::resource('textfiles', 'Api\TextFileController')->only('update');

    Route::put('/dictionaryfiles/{fileId}/{rowId}', 'Api\DictionaryFileController@update');
    Route::delete('/dictionaryfiles/{fileId}/{rowId}', 'Api\DictionaryFileController@destroy');
    Route::post('/dictionaryfiles/{fileId}', 'Api\DictionaryFileController@store');
});
