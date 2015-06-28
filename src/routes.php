<?php

use MPWAR\Routing\Route;

Route::get("/")
	->execute("index@HomeController")
	->respondWith("html")
	->expireAfter(5, Route::MINUTES);
	
Route::get("/hello")
	->execute("hello@HomeController")
	->respondWith("html")
	->expireAfter(5, Route::MINUTES);

Route::get("/user/{id}")
	->where("id", "\d{36}")
	->execute("details@UserController")
	->respondWith("html")
	->expireAfter(5, Route::SECONDS);
