<?php

use Illuminate\Support\Facades\Route;
use LaravelLiberu\Localisation\Http\Controllers\Json\AddKey;
use LaravelLiberu\Localisation\Http\Controllers\Json\Edit;
use LaravelLiberu\Localisation\Http\Controllers\Json\Index;
use LaravelLiberu\Localisation\Http\Controllers\Json\Merge;
use LaravelLiberu\Localisation\Http\Controllers\Json\Update;

Route::get('editTexts', Index::class)->name('editTexts');
Route::get('getLangFile/{language}/{subDir}', Edit::class)->name('getLangFile');
Route::patch('saveLangFile/{language}/{subDir}', Update::class)->name('saveLangFile');
Route::patch('addKey', AddKey::class)->name('addKey');
Route::patch('merge/{locale?}', Merge::class)->name('merge');
