<?php

use Illuminate\Support\Facades\Route;

// defaults
Route::view('/', 'welcome')->name('welcome');
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

// note and history
Route::post('note', 'HistoryController@note')->name('note');
Route::post('note/{history}/edit', 'HistoryController@update')->name('note.update');

// general : user account management
Route::get('acc', 'AccController@edit')->name('acc');
Route::put('acc', 'AccController@update')->name('acc_update');
Route::get('users', 'AccController@index')->name('user.index');
Route::put('users/{user}', 'AccController@admin_update')->name('user.admin_update');

// signups & madadjus
Route::get('ثبت-نام-کارفرما', 'SignupController@organ_form')->name('organ.signup');
Route::get('organ/uid/{uid}', 'SignupController@organ_finished')->name('organ.finished');
Route::post('organ/signup', 'SignupController@organ_register')->name('organ.register');
Route::get('ثبت-نام/{type}/{step?}', 'SignupController@form')->name('signup')->where('type', '[1-3]');
Route::post('wizard/{type}/{step}', 'SignupController@wizard')->name('wizard');
Route::get('madadjus/{type}', 'MadadjuController@index')->name('madadjus');
Route::delete('apply/{type}/{id}', 'MadadjuController@destroy')->name('apply.destroy');
Route::post('apply/accept/{type}/{id}', 'SignupController@accept')->name('apply.accept');
Route::post('apply/reject/{type}/{id}', 'SignupController@reject')->name('apply.reject');
Route::get('madadju/{type}/{id}/edit', 'MadadjuController@edit')->name('madadju.edit');
Route::put('madadju/{type}/{id}/update', 'MadadjuController@update')->name('madadju.update');


// other
Route::get('rahgiri', 'RahgiriController@rahgiri')->name('rahgiri');
Route::get('اطلاعیه-های-عمومی', 'NotificationController@publics')->name('nots');
Route::view('تماس-با-ما', 'contactus')->name('contactus');
Route::get('excel/organ', 'OrganController@export')->name('organ.excel');
Route::get('excel/madadju', 'MadadjuController@export')->name('madadju.excel');

// introduce
Route::get('introduce/{solicit}', 'IntroduceController@introduce_form')->name('introduce.form');
Route::post('introduce/{solicit}', 'IntroduceController@introduce_action')->name('introduce.action');

// resources
Route::resource('expert', 'ExpertController')->except('show');
Route::resource('organ', 'OrganController')->only(['index', 'destroy']);
Route::resource('solicit', 'SolicitController')->except('show');
Route::resource('notification', 'NotificationController')->except('show');
