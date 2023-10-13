<?php

namespace LaravelLiberu\Localisation\State;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use LaravelLiberu\Core\Contracts\ProvidesState;
use LaravelLiberu\Helpers\Services\JsonReader;
use LaravelLiberu\Localisation\Models\Language;

class Localisation implements ProvidesState
{
    protected Collection $languages;

    public function mutation(): string
    {
        return 'localisation/configure';
    }

    public function state(): mixed
    {
        $this->languages = Language::active()
            ->get(['name', 'flag', 'is_rtl']);

        return [
            'i18n' => $this->i18n(),
            'languages' => $this->languages->pluck('flag', 'name'),
            'rtl' => $this->rtl(),
        ];
    }

    private function i18n(): Collection
    {
        return $this->languages
            ->reject(fn ($language) => $language->name === 'en')
            ->mapWithKeys(fn ($language) => [
                $language->name => $this->lang($language),
            ]);
    }

    private function lang(Language $language)
    {
        $file = App::langPath("{$language->name}.json");

        return (new JsonReader($file))->array();
    }

    private function rtl(): Collection
    {
        return $this->languages
            ->filter(fn ($lang) => $lang->is_rtl)->pluck('name');
    }
}
