<?php

Route::get('projects',        'HomeController@projects');
Route::get('content/update',  'HomeController@update')->name('updatecontent');
Route::post('content/update', 'HomeController@updatecontent')->name('updatecontent');

Route::get( '{slug?}',    'HomeController@index')->where('slug','(home)') # Matches / or /home.
->name('home');
Route::post('email/send', 'HomeController@sendEmail')->name('sendcontacemeil'); # Send email.
