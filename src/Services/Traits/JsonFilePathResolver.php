<?php

namespace LaravelLiberu\Localisation\Services\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

trait JsonFilePathResolver
{
    protected function jsonFileName($locale, $subDir = null): string
    {
        $path = Collection::wrap([$subDir, "{$locale}.json"])
            ->filter()->implode('/');

        $basePath = base_path();

        return $subDir === 'liberu'
            ? "{$basePath}/vendor/laravel-liberu/localisation/lang/{$path}"
            : App::langPath($path);
    }

    protected function coreJsonFileName($locale): string
    {
        return $this->jsonFileName($locale, 'liberu');
    }

    protected function appJsonFileName($locale): string
    {
        return $this->jsonFileName($locale, 'app');
    }

    protected function updateDir(): string
    {
        return Config::get('liberu.localisation.core') ? 'liberu' : 'app';
    }
}
