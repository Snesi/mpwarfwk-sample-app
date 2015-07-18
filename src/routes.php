<?php

use MPWAR\Routing\Route;

Route::get("/")
    ->execute("index@WelcomeController")
    ->respondWith("html")
    ->expireAfter(5, Route::MINUTES);

Route::get("/hello/{name}")
    ->execute("hello@WelcomeController")
    ->respondWith("html")
    ->expireAfter(5, Route::MINUTES);

Route::get("/db")
    ->execute("dbTest@WelcomeController")
    ->respondWith("html")
    ->expireAfter(5, Route::MINUTES);
