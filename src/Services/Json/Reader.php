<?php

namespace LaravelEnso\Localisation\Services\Json;

use LaravelEnso\Helpers\Services\JsonReader;
use LaravelEnso\Localisation\Models\Language;
use LaravelEnso\Localisation\Services\Traits\JsonFilePathResolver;

class Reader
{
    use JsonFilePathResolver;

    public function __construct(private readonly Language $language, private readonly ?string $subDirectory = null)
    {
    }

    public function get(): string
    {
        return (new JsonReader($this->filename()))->json();
    }

    private function filename(): string
    {
        return $this->jsonFileName(
            $this->language->name,
            $this->subDirectory
        );
    }
}
