<?php

use App\Models\Menu;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/db', function () {
    return view('dbcon');
});

Route::get('/db-data', function () {
    return view('db-data', ['title' => 'DB-Data', 'menus' => Menu::all(), 'targetMenu' => Menu::find(3)]);
});


Route::get('/menus-management', function () {
    return view('menus.index', ['menus' => Menu::all()]);
});
