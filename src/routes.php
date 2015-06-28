<?php	

use MPWAR\Route;

return [
	Route::get("/")
		->execute("index@HomeController")
		->respondWith("html")
		->expireAfter(5, Route::MINUTES),
	Route::get("/hello")
		->execute("hello@HomeController")
		->respondWith("html")
		->expireAfter(5, Route::MINUTES)
];