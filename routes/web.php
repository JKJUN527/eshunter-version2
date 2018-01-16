<?php

Route::any('/', function(){
	return view('index');
});

Route::any('about', function(){
	return view('about');
});