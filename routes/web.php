<?php

Route::get('/', 'PagesController@root')->name('root');
Auth::routes(['verify' => true]);

Route::resource('users', 'UsersController', ['only' => ['show', 'edit', 'update']]);