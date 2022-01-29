<?php

namespace App\Frontend;

use App\Entity\Title;

class Breadcrumb
{

    public static function getHome(): array
    {
        return [
            'uri' => '/',
            'text' => 'Главная',
        ];
    }

    public static function generateShort(string $uri, string $text): array
    {
        return [
            self::getHome(),
            [
                'uri' => $uri,
                'text' => $text,
            ],
        ];
    }

    public static function generateForTitle(Title $title): array
    {
        return [
            self::getHome(),
            [
                'uri' => '/anime',
                'text' => 'Аниме',
            ],
            [
                'uri' => $title->getPageUri(),
                'text' => $title->getName(),
            ],
        ];
    }

}