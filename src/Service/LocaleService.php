<?php

namespace App\Service;

class LocaleService
{
    public function germanSpeaker(): bool
    {
        $acceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

        return str_contains($acceptLanguage, 'de');
    }
}
