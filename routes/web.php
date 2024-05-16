<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PizzaController;


Route::get('/', [PizzaController::class, 'index'])->name( 'show.orderform' );

Route::post('/', [PizzaController::class, 'store'])->name( 'submit.orderform' );
