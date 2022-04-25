<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/manage-category', [CategoryController::class, 'index'])->name('index.category');
Route::get('/add-category', [CategoryController::class, 'create'])->name('add.category');
Route::post('/store-category', [CategoryController::class, 'store'])->name('new.category');
Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit.category');
Route::post('/delete-category/{category}', [CategoryController::class, 'destroy'])->name('delete.category');

Route::get('/manage-subcategory', [SubcategoryController::class, 'index'])->name('index.subcategory');
Route::get('/add-subcategory', [SubcategoryController::class, 'create'])->name('add.subcategory');
Route::post('/store-subcategory', [SubcategoryController::class, 'store'])->name('new.subcategory');
Route::get('/edit-subcategory/{id}', [SubcategoryController::class, 'edit'])->name('edit.subcategory');
Route::post('/delete-subcategory/{subcategory}', [SubcategoryController::class, 'destroy'])->name('delete.subcategory');
