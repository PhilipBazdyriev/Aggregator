<?php

namespace App\Controller;

use App\Repository\TitleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/title/list", name="api_title_list")
     */
    public function titleList(TitleRepository $repository): Response
    {
        $list = $repository->findAll();
        return $this->json([
            'ok' => 1,
            'list' => $list,
        ]);
    }
}
