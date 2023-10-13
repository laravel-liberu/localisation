<?php

use Illuminate\Support\Facades\Route;
use LaravelLiberu\Localisation\Http\Controllers\Language\Create;
use LaravelLiberu\Localisation\Http\Controllers\Language\Destroy;
use LaravelLiberu\Localisation\Http\Controllers\Language\Edit;
use LaravelLiberu\Localisation\Http\Controllers\Language\ExportExcel;
use LaravelLiberu\Localisation\Http\Controllers\Language\InitTable;
use LaravelLiberu\Localisation\Http\Controllers\Language\Options;
use LaravelLiberu\Localisation\Http\Controllers\Language\Store;
use LaravelLiberu\Localisation\Http\Controllers\Language\TableData;
use LaravelLiberu\Localisation\Http\Controllers\Language\Update;

Route::get('create', Create::class)->name('create');
Route::post('', Store::class)->name('store');
Route::get('{language}/edit', Edit::class)->name('edit');
Route::patch('{language}', Update::class)->name('update');
Route::delete('{language}', Destroy::class)->name('destroy');

Route::get('initTable', InitTable::class)->name('initTable');
Route::get('tableData', TableData::class)->name('tableData');
Route::get('exportExcel', ExportExcel::class)->name('exportExcel');
Route::get('options', Options::class)->name('options');
