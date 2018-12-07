<?php

Route::group([
      'prefix' => 'admin',
      'namespace' => 'Avl\Logger\Http\Controllers\Admin',
      'middleware' => config('avllogger.middleware'),
      'as' => 'avllogger::'
], function () {

  Route::get('logger', 'LoggerController@index')->name('index');
  Route::get('logger/{id}', 'LoggerController@show')->name('show');

});
