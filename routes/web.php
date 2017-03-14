<?php

Route::get('projects', 'HomeController@projects');

Route::get('{home?}', 'HomeController@index')->name('home');
Route::post('home', 'HomeController@sendEmail'); # Send email.
