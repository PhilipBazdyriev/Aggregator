<?php

namespace App\Controller;

use App\ContentParsing\Shikimori\ListingLoader;
use App\ContentParsing\Shikimori\Utils;
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
        $date = "23 сент. 2014";
        $result = Utils::StrToDate($date);
        return new Response($result->format('d-m-Y'));
    }
}
