<?php

namespace LaravelLiberu\Localisation\Http\Controllers\Language;

use Illuminate\Routing\Controller;
use LaravelLiberu\Localisation\Http\Requests\ValidateLanguage;
use LaravelLiberu\Localisation\Models\Language;
use LaravelLiberu\Localisation\Services\Updater;

class Update extends Controller
{
    public function __invoke(ValidateLanguage $request, Language $language)
    {
        (new Updater(
            $language,
            $request->validatedExcept('flag_sufix'),
            $request->get('flag_sufix')
        ))->run();

        return ['message' => __('The language was successfully updated')];
    }
}
