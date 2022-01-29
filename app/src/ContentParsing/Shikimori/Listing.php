<?php

namespace App\ContentParsing\Shikimori;

use App\Entity\TitleSourcePage;
use Doctrine\Persistence\ManagerRegistry;

class Listing
{

    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function run($pageCount):int
    {

    }

    /**
     * @throws \Exception
     */
    public function listPage($type, $page):int
    {
        if ($type != 'anime' && $type != 'manga') {
            throw new \Exception('Wrong type!');
        }

        $newUrlCount = 0;

        $repo = $this->registry->getRepository(TitleSourcePage::class);
        $entityManager = $this->registry->getManager();

        $loader = new ListingLoader($type);
        $listing = $loader->loadPage($page);
        if ($listing) {
            $now = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            foreach ($listing as $url) {

                $titleSourcePage = $repo->findByUrl($url);
                if (!$titleSourcePage) {
                    $titleSourcePage = new TitleSourcePage();
                    $titleSourcePage->setSourceAlias('shikimori');
                    $titleSourcePage->setUrl($url);
                    $titleSourcePage->setCreateTime($now);
                    $titleSourcePage->setType($type);

                    $entityManager->persist($titleSourcePage);
                    $newUrlCount++;
                }
            }
            $entityManager->flush();
        }

        return $newUrlCount;
    }
}