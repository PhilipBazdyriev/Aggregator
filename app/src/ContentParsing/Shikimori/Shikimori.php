<?php

namespace App\ContentParsing\Shikimori;

use App\ContentParsing\Shikimori\ListingLoader;
use App\Entity\TitleSourcePage;
use App\Repository\TitleSourcePageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Style\SymfonyStyle;

class Shikimori
{

    private $registry;
    private $listing;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
        $this->listing = new Listing($registry);
    }

    public function list($pageCount):int
    {
        return $this->listing->run($pageCount);
    }


}