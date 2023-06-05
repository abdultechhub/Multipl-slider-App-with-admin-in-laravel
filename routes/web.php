<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Front\HomeController;

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

Route::get('/',[HomeController::class, 'index']);


Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::delete('/slider/delete_single_slide_item/{id}', [SliderController::class, 'delete_single_slide_item'])->name('slider.delete_single_slide_item');
    Route::POST('/slider/changestatus', [SliderController::class, 'changestatus'])->name('slider.changestatus');
    Route::post('/slider/trash/{id}', [SliderController::class, 'trash'])->name('slider.trash');
    Route::get('/slider-item/{id}',[SliderController::class, 'add_slider_item']);
    Route::post('/store_slider_item',[SliderController::class, 'store_slider_item'])->name('slider.store_slider_item');
    Route::resource('/slider', SliderController::class);
});