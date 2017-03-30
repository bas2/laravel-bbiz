<?php
Route::get('projects',        'HomeController@projects');
Route::get('content/update',  'HomeController@update')->name('updatecontent')
->middleware('auth');
Route::post('content/update', 'HomeController@updatecontent')->name('updatecontent')
->middleware('auth');

Route::post('travelodge/update/today', 'HomeController@postUpdateTravToday')
->middleware('auth');

Route::get('login', 'HomeController@getlogin')->name('login');
Route::post('login', 'HomeController@postlogin')->name('postlogin');
Route::get('logout', 'HomeController@getlogout')->name('getlogout');

Route::get( '{slug?}',    'HomeController@index')->where('slug','(home)') # Matches / or /home.
->name('home');
Route::post('email/send', 'HomeController@sendEmail')->name('sendcontacemeil'); # Send email.
