<?php

namespace LaravelLiberu\Localisation\Http\Controllers\Language;

use Illuminate\Routing\Controller;
use LaravelLiberu\Localisation\Tables\Builders\Language;
use LaravelLiberu\Tables\Traits\Data;

class TableData extends Controller
{
    use Data;

    protected $tableClass = Language::class;
}
