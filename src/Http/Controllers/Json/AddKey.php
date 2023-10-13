<?php

namespace LaravelLiberu\Localisation\Http\Controllers\Json;

use Illuminate\Support\Collection;
use LaravelLiberu\Localisation\Http\Requests\ValidateKey;
use LaravelLiberu\Localisation\Models\Language;
use LaravelLiberu\Localisation\Services\Json\Updater;

class AddKey
{
    public function __invoke(ValidateKey $request, Language $language)
    {
        $keys = Collection::wrap($request->get('keys'))
            ->mapWithKeys(fn ($key) => [$key => null])
            ->toArray();

        (new Updater($language, $keys))->addKey();

        return ['message' => __('The translation key was successfully added')];
    }
}
