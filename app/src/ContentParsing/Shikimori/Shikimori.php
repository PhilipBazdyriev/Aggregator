<?php

namespace App\ContentParsing\Shikimori;

use App\ContentParsing\Shikimori\ListingLoader;
use App\Entity\ArticleSourcePage;
use App\Repository\ArticleSourcePageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Style\SymfonyStyle;

class Shikimori
{

    private $listing;
    private $content;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->listing = new Listing($managerRegistry);
        $this->content = new Content($managerRegistry);
    }

    public function list($pageCount):array
    {
        return $this->listing->run($pageCount);
    }

    public function loadContent($count):array
    {
        return $this->content->run($count);
    }


}