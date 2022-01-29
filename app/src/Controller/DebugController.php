<?php

namespace App\Controller;

use App\ContentParsing\Shikimori\ListingLoader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DebugController extends AbstractController
{
    /**
     * @Route("/debug/test", name="debug_test")
     */
    public function index(): Response
    {
        $loader = new ListingLoader('mangas'); // animes mangas
        $result = $loader->loadPage(1);
        dump($result);
        return $this->render('debug/index.html.twig', [
            'controller_name' => 'DebugController',
        ]);
    }
}
