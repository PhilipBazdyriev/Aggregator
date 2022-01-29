<?php

namespace App\Twig;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('getBreadcrumb', [$this, 'getBreadcrumb']),
        ];
    }

    public function getBreadcrumb(): array
    {

    }
}
