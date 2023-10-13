<?php

namespace LaravelLiberu\Localisation\Http\Controllers\Language;

use Illuminate\Routing\Controller;
use LaravelLiberu\Localisation\Forms\Builders\Language as Form;
use LaravelLiberu\Localisation\Models\Language;

class Edit extends Controller
{
    public function __invoke(Language $language, Form $form)
    {
        return ['form' => $form->edit($language)];
    }
}
