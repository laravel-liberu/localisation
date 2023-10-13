<?php

namespace LaravelLiberu\Localisation\Http\Controllers\Json;

use LaravelLiberu\Localisation\Models\Language;

class Index
{
    public function __invoke()
    {
        return Language::extra()->get()->map(fn ($locale) => [
            'id' => $locale->id,
            'name' => $locale->display_name,
        ]);
    }
}
