<?php

use App\Http\Controllers\MenusController;
use App\Http\Controllers\MenusDeckController;
use App\Http\Controllers\MenusDeckExpensesController;
use App\Http\Controllers\MenusDeckPaymentsController;
use App\Http\Controllers\MenusRecomenderController;
use App\Http\Controllers\VendorsController;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/db', function () {
    return view('dbcon');
});

Route::get('/db-data', function () {
    return view('db-data', ['title' => 'DB-Data', 'menus' => Menu::all(), 'targetMenu' => Menu::find(1)]);
});

// Master
Route::resource('menus', MenusController::class);
Route::resource('vendors', VendorsController::class);


// Transaksi
Route::resource('menus-deck', MenusDeckController::class);
Route::resource('menus-recommender', MenusRecomenderController::class);
Route::resource('menus-deck-expenses', MenusDeckExpensesController::class);
Route::resource('menus-deck-payments', MenusDeckPaymentsController::class);

Route::post('/menus-recommender/calculate-similarity', [MenusRecomenderController::class, 'calculateSimilarity'])->name('menus-recommender.similarity');
Route::get('menus-deck/create/{menu_id?}', [MenusDeckController::class, 'create'])->name('menus-deck.create');
Route::patch('/menus-deck-expenses/{id}/delete', [MenusDeckExpensesController::class, 'delete'])->name('menus-deck-expenses.delete');
Route::post('/menus-recommender/ge', [MenusRecomenderController::class, 'calculateSimilarity'])->name('menus-recommender.similarity');



