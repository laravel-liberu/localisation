<?php

namespace LaravelLiberu\Localisation\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use LaravelLiberu\Localisation\Models\Language;
use LaravelLiberu\Localisation\Services\Traits\JsonFilePathResolver;

class Updater
{
    use JsonFilePathResolver;

    public function __construct(
        private readonly Language $language,
        private readonly array $request,
        private readonly string $flagSuffix
    ) {
    }

    public function run()
    {
        DB::transaction(function () {
            $oldName = $this->language->name;
            $this->language->updateWithFlagSufix($this->request, $this->flagSuffix);
            $this->updateLangFiles($oldName, $this->request['name']);
        });
    }

    public function updateJson($oldName, $newName): void
    {
        File::move(
            $this->jsonFileName($oldName),
            $this->jsonFileName($newName)
        );
    }

    public function updateAppJson($oldName, $newName): void
    {
        File::move(
            $this->jsonFileName($oldName, 'app'),
            $this->jsonFileName($newName, 'app')
        );
    }

    public function updateEnsoJson($oldName, $newName): void
    {
        File::move(
            $this->jsonFileName($oldName, 'liberu'),
            $this->jsonFileName($newName, 'liberu')
        );
    }

    private function updateLangFiles(string $oldName, string $newName): void
    {
        if ($oldName === $newName) {
            return;
        }

        $this->updateJson($oldName, $newName);
        $this->updateAppJson($oldName, $newName);
        $this->updateEnsoJson($oldName, $newName);
        $this->updateLegacyFolder($oldName, $newName);
    }

    private function updateLegacyFolder($oldName, $newName): void
    {
        File::moveDirectory(App::langPath($oldName), App::langPath($newName));
    }
}
