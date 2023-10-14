<?php

namespace LaravelLiberu\Localisation\Exceptions;

use LaravelLiberu\Helpers\Exceptions\LiberuException;

class Localisation extends LiberuException
{
    public static function legacyFolderExists($locale, $folder)
    {
        return new self(__(
            "Can't create the language for locale :locale. The legacy folder :folder already exists",
            ['locale' => $locale, 'folder' => $folder]
        ));
    }
}
