<?php

namespace LaravelLiberu\Localisation\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use LaravelLiberu\Localisation\Models\Language;
use LaravelLiberu\Localisation\Services\Traits\JsonFilePathResolver;

class Destroyer
{
    use JsonFilePathResolver;

    public function __construct(private readonly Language $language)
    {
    }

    public function run(): void
    {
        $this->language->delete();
        File::deleteDirectory(App::langPath($this->language->name));
        File::delete($this->jsonFileName($this->language->name, 'liberu'));
        File::delete($this->jsonFileName($this->language->name, 'app'));
        File::delete($this->jsonFileName($this->language->name));
    }
}
