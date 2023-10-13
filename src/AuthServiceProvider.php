<?php

namespace LaravelLiberu\Localisation;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelLiberu\Localisation\Models\Language;
use LaravelLiberu\Localisation\Policies\Language as Policy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Language::class => Policy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
