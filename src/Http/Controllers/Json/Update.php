<?php

namespace LaravelLiberu\Localisation\Http\Controllers\Json;

use Illuminate\Http\Request;
use LaravelLiberu\Localisation\Models\Language;
use LaravelLiberu\Localisation\Services\Json\Updater;

class Update
{
    public function __invoke(Request $request, Language $language, string $subDir)
    {
        (new Updater(
            $language,
            $request->get('langFile'),
            $subDir
        ))->run();

        return ['message' => __('The language files were successfully updated')];
    }
}
