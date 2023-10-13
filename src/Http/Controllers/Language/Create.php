<?php

namespace LaravelLiberu\Localisation\Http\Controllers\Language;

use Illuminate\Routing\Controller;
use LaravelLiberu\Localisation\Forms\Builders\Language;

class Create extends Controller
{
    public function __invoke(Language $form)
    {
        return ['form' => $form->create()];
    }
}
