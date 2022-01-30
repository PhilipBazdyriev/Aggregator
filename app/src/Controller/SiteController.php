<?php

namespace App\Controller;

use App\Frontend\Breadcrumb;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findAll();
        return $this->render('site/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/anime", name="anime")
     */
    public function anime(ArticleRepository $repo): Response
    {
        $articles = $repo->findAll();
        return $this->render('site/index.html.twig', [
            'articles' => $articles,
            'breadcrumb' => Breadcrumb::generateShort('/anime', 'Аниме'),
        ]);
    }

    /**
     * @Route("/anime/{page_uri}", name="anime_article")
     */
    public function animearticle($page_uri, ArticleRepository $repo): Response
    {
        $article = $repo->findOneByUriAlias($page_uri);
        return $this->render('site/article.html.twig', [
            'article' => $article,
            'breadcrumb' => Breadcrumb::generateForarticle($article),
        ]);
    }

}
