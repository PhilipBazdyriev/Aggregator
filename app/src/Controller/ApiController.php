<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/article/list", name="api_article_list")
     */
    public function articleList(ArticleRepository $repository): Response
    {
        $list = $repository->findAll();
        return $this->json([
            'ok' => 1,
            'list' => $list,
        ]);
    }
}
