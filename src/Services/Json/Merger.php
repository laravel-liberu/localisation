<?php

namespace LaravelLiberu\Localisation\Services\Json;

class Merger extends Handler
{
    public function run(?string $locale = null): void
    {
        $this->merge($locale);
    }
}
