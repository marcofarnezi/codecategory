<?php

Route::group(
    [
        'middleware' => ['web'],
        'prefix' => 'admin/categories',
        'as' => 'admin.categories.',
        'namespace' => 'CodePress\CodeCategory\Controllers'
    ],
    function () {
        Route::get('/', ['uses' => 'AdminCategoryController@index', 'as' => 'index']);
        Route::get('/create', ['uses' => 'AdminCategoryController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'AdminCategoryController@store', 'as' => 'store']);
});
