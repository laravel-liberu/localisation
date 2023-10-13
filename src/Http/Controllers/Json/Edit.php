<?php

namespace LaravelLiberu\Localisation\Http\Controllers\Json;

use LaravelLiberu\Localisation\Models\Language;
use LaravelLiberu\Localisation\Services\Json\Reader;

class Edit
{
    public function __invoke(Language $language, string $subDir)
    {
        return (new Reader($language, $subDir))->get();
    }
}
