<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => '\Dizatech\Tag\Http\Controllers',
    'prefix' => 'panel',
    'middleware' => ['web', 'auth', 'verified']
], function () {
    Route::resource('tags', 'TagController');
    Route::get('/ajax/search/tags', 'TagController@ajax_search_tags')->name('tags.ajax_search');
});
