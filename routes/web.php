<?php

Route::get('projects',    'HomeController@projects');

Route::get( '{slug?}',    'HomeController@index')->where('slug','(home)') # Matches / or /home.
->name('home');
Route::post('email/send', 'HomeController@sendEmail')->name('sendcontacemeil'); # Send email.
