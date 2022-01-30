<?php

namespace App\ContentParsing\Shikimori;

use App\Entity\ArticleSourcePage;
use Doctrine\Persistence\ManagerRegistry;

class Content
{
    private $managerRegistry;
    private $aspRepo;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
        $this->aspRepo = $this->managerRegistry->getRepository(ArticleSourcePage::class);
    }

    public function run($count): array
    {
        $result = [];
        for ($p = 0; $p < $count; $p++) {
            $asp = $this->selectArticleSourcePage();
            if ($asp) {
                $result[] = $this->loadArticleSourcePage($asp);
            } else {
                break;
            }
        }
        return $result;
    }

    private function selectArticleSourcePage(): ArticleSourcePage
    {
        $aspList = $this->aspRepo->getForScanning(1);
        return $aspList[0];
    }

    private function loadArticleSourcePage(ArticleSourcePage $asp)
    {
        $contentLoader = new ContentLoader();
        $articleData = $contentLoader->load($asp);
        dump($articleData);
        exit;
    }

}