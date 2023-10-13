<?php

namespace LaravelLiberu\Localisation\Services\Json;

use LaravelLiberu\Helpers\Services\JsonReader;
use LaravelLiberu\Localisation\Models\Language;
use LaravelLiberu\Localisation\Services\Traits\JsonFilePathResolver;

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
