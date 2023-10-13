<?php

namespace LaravelLiberu\Localisation\Services\Json;

use Illuminate\Support\Collection;
use LaravelLiberu\Helpers\Services\JsonReader;
use LaravelLiberu\Localisation\Models\Language;

class Updater extends Handler
{
    private readonly ?string $locale;

    public function __construct(Language $language, private readonly array $langArray, private readonly ?string $subDir = null)
    {
        $this->locale = $language->name;
    }

    public function run()
    {
        $this->savePartial(
            $this->locale,
            $this->langArray,
            $this->subDir
        );

        $this->extraLangs()
            ->each(fn ($locale) => $this->updateDifferences($locale));
    }

    public function addKey()
    {
        $this->extraLangs()
            ->each(fn ($locale) => $this->processKey($locale));
    }

    private function processKey($locale)
    {
        $extraLangFile = $this->extraLangFile($locale, $this->updateDir());
        [$addedCount, $extraLangFile] = $this->addNewKeys($extraLangFile);
        $this->savePartial($locale, $extraLangFile, $this->updateDir());
    }

    private function updateDifferences(string $locale)
    {
        $removedCount = $addedCount = 0;
        $extraLangFile = $this->extraLangFile($locale, $this->subDir);
        [$removedCount, $extraLangFile] = $this->removeExtraKeys($extraLangFile);
        [$addedCount, $extraLangFile] = $this->addNewKeys($extraLangFile);

        if ($addedCount || $removedCount) {
            $this->savePartial($locale, $extraLangFile, $this->subDir);
        }
    }

    private function removeExtraKeys(array $extraLangFile)
    {
        $keysToRemove = Collection::wrap($extraLangFile)
            ->diffKeys($this->langArray)
            ->keys();

        $extraLangFile = Collection::wrap($extraLangFile)
            ->filter(fn ($key) => $keysToRemove->contains($key));

        return [$keysToRemove->count(), $extraLangFile->toArray()];
    }

    private function addNewKeys(array $extraLangFile)
    {
        $keysToAdd = Collection::wrap($this->langArray)
            ->diffKeys($extraLangFile);

        $arrayToAdd = $this->newTranslations($keysToAdd->all());

        $extraLangFile = Collection::wrap($arrayToAdd)
            ->merge($extraLangFile);

        return [$keysToAdd->count(), $extraLangFile->toArray()];
    }

    private function extraLangFile(string $locale, string $subDir)
    {
        return (new JsonReader($this->jsonFileName($locale, $subDir)))->array();
    }

    private function extraLangs()
    {
        return Language::extra()
            ->where('name', '<>', $this->locale)
            ->pluck('name');
    }
}
