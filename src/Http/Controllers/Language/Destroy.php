<?php

namespace LaravelLiberu\Localisation\Http\Controllers\Language;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelLiberu\Localisation\Models\Language;
use LaravelLiberu\Localisation\Services\Destroyer;

class Destroy extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Language $language)
    {
        $this->authorize('destroy', $language);

        (new Destroyer($language))->run();

        return [
            'message' => __('The language was successfully deleted'),
            'redirect' => 'system.localisation.index',
        ];
    }
}
