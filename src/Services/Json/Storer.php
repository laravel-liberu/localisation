<?php

namespace LaravelEnso\Localisation\Services\Json;

use LaravelEnso\Helpers\Services\JsonReader;
use LaravelEnso\Localisation\Models\Language;

class Storer extends Handler
{
    public function __construct(private readonly string $locale)
    {
    }

    public function create()
    {
        $core = $this->newTranslations(
            $this->existingTranslations('enso')
        );

        $this->savePartial($this->locale, $core->all(), 'enso');

        $app = $this->newTranslations(
            $this->existingTranslations('app')
        );

        $this->savePartial($this->locale, $app->all(), 'app');

        $this->saveToDisk($this->locale, $core->merge($app)->all());
    }

    private function existingTranslations(string $subDirectory)
    {
        return (new JsonReader($this->filename($subDirectory)))->array();
    }

    private function filename($subDirectory)
    {
        return $this->jsonFileName(
            Language::extra()->first()->name,
            $subDirectory
        );
    }
}
