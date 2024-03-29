<?php

namespace LaravelLiberu\Localisation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use LaravelLiberu\Localisation\Models\Language;

class LanguageSeeder extends Seeder
{
    protected array $languages = [
        ['name' => 'ro', 'display_name' => 'Romana', 'flag' => 'flag-icon flag-icon-ro', 'is_rtl' => false, 'is_active' => true],
        ['name' => 'en', 'display_name' => 'English-GB', 'flag' => 'flag-icon flag-icon-gb', 'is_rtl' => false, 'is_active' => true],
        ['name' => 'de', 'display_name' => 'German', 'flag' => 'flag-icon flag-icon-de', 'is_rtl' => false, 'is_active' => true],
        ['name' => 'nl', 'display_name' => 'Nederlands', 'flag' => 'flag-icon flag-icon-nl', 'is_rtl' => false, 'is_active' => true],
        ['name' => 'fr', 'display_name' => 'Français', 'flag' => 'flag-icon flag-icon-fr', 'is_rtl' => false, 'is_active' => true],
        ['name' => 'br', 'display_name' => 'Brazilian Portuguese', 'flag' => 'flag-icon flag-icon-br', 'is_rtl' => false, 'is_active' => true],
        ['name' => 'ar', 'display_name' => 'Arabic', 'flag' => 'flag-icon flag-icon-eg', 'is_rtl' => true, 'is_active' => true],
        ['name' => 'mn', 'display_name' => 'Mongolia', 'flag' => 'flag-icon flag-icon-mn', 'is_rtl' => false, 'is_active' => true],
        ['name' => 'hu', 'display_name' => 'Magyar', 'flag' => 'flag-icon flag-icon-hu', 'is_rtl' => false, 'is_active' => true],
        ['name' => 'es', 'display_name' => 'Español', 'flag' => 'flag-icon flag-icon-es', 'is_rtl' => false, 'is_active' => true],
        ['name' => 'ru', 'display_name' => 'Russian', 'flag' => 'flag-icon flag-icon-ru', 'is_rtl' => false, 'is_active' => true],
    ];

    public function run()
    {
        Collection::wrap($this->languages)
            ->each(fn ($language) => Language::factory()->create($language));
    }
}
