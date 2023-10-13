<?php

namespace LaravelLiberu\Localisation\Services;

use Illuminate\Support\Facades\DB;
use LaravelLiberu\Localisation\Models\Language;
use LaravelLiberu\Localisation\Services\Json\Storer as JsonStorer;
use LaravelLiberu\Localisation\Services\Legacy\Storer as LegacyStorer;

class Storer
{
    public function __construct(
        private readonly array $request,
        private readonly ?string $flagSuffix
    ) {
    }

    public function create()
    {
        return DB::transaction(function () {
            $language = (new Language())
                ->storeWithFlagSufix($this->request, $this->flagSuffix);

            (new LegacyStorer($this->request['name']))->create();
            (new JsonStorer($this->request['name']))->create();

            return $language;
        });
    }
}
