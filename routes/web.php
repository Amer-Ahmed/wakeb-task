<?php

Route::get('/', 'ProfileController@index');
Route::resource('profiles', 'ProfileController')->except('index');