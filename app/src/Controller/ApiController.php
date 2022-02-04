<?php

namespace App\Controller;

use App\ContentParsing\Shikimori\Shikimori;
use App\ContentParsing\YummyAnime\YummyAnime;
use App\Entity\ArticleSourcePage;
use App\Repository\ArticleRepository;
use App\Repository\ArticleSourcePageRepository;
use App\Tools\Time;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/*

Получить список ссылок:
POST: /articleSourcePage/list/forScanning

Сохранить список ссылок:
GET:  /articleSourcePage/list

Получить статистику по списку ссылок:
GET:  /articleSourcePage/stats

Сохранить тайтл:
POST: /article

Получить тайтл:
GET:  /article

*/

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{

    /**
     * @Route("/articleSourcePage/list/forScanning", methods={"GET"})
     */
    public function getArticleSourcePageList(ArticleSourcePageRepository $repository): Response
    {
        $items = $repository->getForScanning(10);
        return $this->json([
            'ok' => 1,
            'list' => $items,
        ]);
    }

    /**
     * @Route("/articleSourcePage/stats")
     */
    public function articleSourcePageStats(ArticleSourcePageRepository $repository): Response
    {
        $sourceList = [YummyAnime::ALIAS, Shikimori::ALIAS];
        $result = [];
        foreach ($sourceList as $source) {
            $result[$source] = [
                'scanned' => $repository->getScannedCount($source),
                'not_scanned' => $repository->getNotScannedCount($source),
            ];
        }
        return $this->json([
            'ok' => 1,
            'sources' => $result,
        ]);
    }

    /**
     * @Route("/articleSourcePage/list", methods={"POST"})
     */
    public function saveArticleSourcePageList(Request $request, ArticleSourcePageRepository $repository, ManagerRegistry $registry): Response
    {
        $list = json_decode($request->getContent(), true);
        if (!is_array($list)) {
            return $this->json([
                'ok' => 0,
            ]);
        }
        $result = [];
        $manager = $registry->getManager();
        foreach ($list as $item) {
            $asp = $repository->findByUrl($item['url']);
            if (!$asp) {
                $asp = new ArticleSourcePage();
                $asp->setSourceAlias($item['source_alias']);
                $asp->setType($item['type']);
                $asp->setUrl($item['url']);
                $asp->setCreateTime(Time::now());
            }
            // $asp->setLastScanTime(Time::now());
            $manager->persist($asp);
        }
        $manager->flush();
        return $this->json([
            'ok' => 1,
        ]);
    }


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
