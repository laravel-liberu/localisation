<?php

namespace LaravelLiberu\Localisation\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use LaravelLiberu\Localisation\Services\Traits\JsonFilePathResolver;

class SanitizeAppKeys
{
    use JsonFilePathResolver;

    private readonly Collection $app;
    private readonly Collection $core;

    public function __construct(array $app, array $core)
    {
        $this->app = new Collection($app);
        $this->core = new Collection($core);
    }

    public function sanitize(string $locale): array
    {
        $sanitized = $this->app->reject(fn ($value, $key) => $this->core
            ->keys()->contains($key))->sortKeys()->toArray();

        File::put(
            $this->appJsonFileName($locale),
            json_encode($sanitized, JSON_FORCE_OBJECT)
        );

        return $sanitized;
    }
}
