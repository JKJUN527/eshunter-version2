<?php

Route::any('/', function(){
	return view('index/index');
});
Route::any('index', function(){
	return view('index/index');
});
Route::any('index/index', function(){
	return view('index/index');
});

Route::any('about', function(){
	return view('about/about');
});
Route::any('news/news_center', function(){
	return view('news/news_center');
});
Route::any('jobs/jobs_search', function(){
	return view('jobs/jobs_search');
});
Route::any('master/master_lib', function(){
	return view('master/master_lib');
});