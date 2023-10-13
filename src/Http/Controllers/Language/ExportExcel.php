<?php

namespace LaravelLiberu\Localisation\Http\Controllers\Language;

use Illuminate\Routing\Controller;
use LaravelLiberu\Localisation\Tables\Builders\Language;
use LaravelLiberu\Tables\Traits\Excel;

class ExportExcel extends Controller
{
    use Excel;

    protected $tableClass = Language::class;
}
