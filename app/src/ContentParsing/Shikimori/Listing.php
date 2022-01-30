<?php

namespace App\ContentParsing\Shikimori;

use App\Entity\Article;
use App\Entity\ArticleSourcePage;
use Doctrine\Persistence\ManagerRegistry;

class Listing
{

    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function run($pageCount): array
    {
        $newUrls = [];
        $newUrls += $this->listPage(Article::ANIME, 1); // TODO доделать скан
        for ($p = 0; $p < $pageCount; $p++) {
            //$newUrls += $this->listPage('anime', 1);
        }
        return $newUrls;
    }

    /**
     * @throws \Exception
     */
    public function listPage($type, $page): array
    {
        if ($type != Article::ANIME && $type != Article::MANGA) {
            throw new \Exception('Wrong type!');
        }

        $newUrls = [];

        $repo = $this->managerRegistry->getRepository(ArticleSourcePage::class);
        $entityManager = $this->managerRegistry->getManager();

        $loader = new ListingLoader($type);
        $listing = $loader->loadPage($page);
        if ($listing) {
            $now = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            foreach ($listing as $url) {

                $articleSourcePage = $repo->findByUrl($url);
                if (!$articleSourcePage) {
                    $articleSourcePage = new ArticleSourcePage();
                    $articleSourcePage->setSourceAlias('shikimori');
                    $articleSourcePage->setUrl($url);
                    $articleSourcePage->setCreateTime($now);
                    $articleSourcePage->setType($type);

                    $entityManager->persist($articleSourcePage);
                    $newUrls[] = $url;
                }
            }
            $entityManager->flush();
        }

        return $newUrls;
    }
}