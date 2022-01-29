<?php

namespace App\Controller;

use App\Frontend\Breadcrumb;
use App\Repository\TitleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index(TitleRepository $repo): Response
    {
        $titles = $repo->findAll();
        return $this->render('site/index.html.twig', [
            'titles' => $titles,
        ]);
    }

    /**
     * @Route("/anime", name="anime")
     */
    public function anime(TitleRepository $repo): Response
    {
        $titles = $repo->findAll();
        return $this->render('site/index.html.twig', [
            'titles' => $titles,
            'breadcrumb' => Breadcrumb::generateShort('/anime', 'Аниме'),
        ]);
    }

    /**
     * @Route("/anime/{page_uri}", name="anime_title")
     */
    public function animeTitle($page_uri, TitleRepository $repo): Response
    {
        $title = $repo->findOneByUriAlias($page_uri);
        return $this->render('site/title.html.twig', [
            'title' => $title,
            'breadcrumb' => Breadcrumb::generateForTitle($title),
        ]);
    }

}
