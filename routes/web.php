<?php

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

Route::group(['prefix' => 'strategyPattern'], function () {
	Route::get('/calculateIssTax', 'StrategyPatternTaxCalculatorController@calculateIssTax');
	Route::get('/calculateIcmsTax', 'StrategyPatternTaxCalculatorController@calculateIcmsTax');
	Route::get('/calculateInssTax', 'StrategyPatternTaxCalculatorController@calculateInssTax');
	Route::get('/calculateFgtsTax', 'StrategyPatternTaxCalculatorController@calculateFgtsTax');
	Route::get('/calculateAllTax', 'StrategyPatternTaxCalculatorController@calculateAllTax');
});