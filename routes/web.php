<?php

Route::get('/', 'PatternController@index');

Route::get('/search', 'PatternController@searchResults');