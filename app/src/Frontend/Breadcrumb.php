<?php

namespace App\Frontend;

use App\Entity\Article;

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

    public static function generateForarticle(Article $article): array
    {
        return [
            self::getHome(),
            [
                'uri' => '/anime',
                'text' => 'Аниме',
            ],
            [
                'uri' => $article->getPageUri(),
                'text' => $article->getName(),
            ],
        ];
    }

}