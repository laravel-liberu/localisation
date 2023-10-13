<?php

namespace LaravelLiberu\Localisation\Tables\Builders;

use Illuminate\Database\Eloquent\Builder;
use LaravelLiberu\Localisation\Models\Language as Model;
use LaravelLiberu\Tables\Contracts\Table;

class Language implements Table
{
    protected const TemplatePath = __DIR__.'/../Templates/languages.json';

    public function query(): Builder
    {
        return Model::selectRaw('
            languages.id, languages.display_name, languages.name,
            languages.flag, is_rtl, is_active, languages.created_at
        ');
    }

    public function templatePath(): string
    {
        return self::TemplatePath;
    }
}
