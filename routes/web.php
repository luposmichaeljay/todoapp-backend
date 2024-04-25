<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $name = request('name');

    $greetings = ['Hello', 'wew'];
    return Arr::random($greetings).','.$name;
});
