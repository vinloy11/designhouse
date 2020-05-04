<?php

Route::get('/', function () {
    return response()->json(['message' => 'Hello world'], 200);
});

