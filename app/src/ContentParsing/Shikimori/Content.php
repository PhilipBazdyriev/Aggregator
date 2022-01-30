<?php

namespace App\ContentParsing\Shikimori;

use App\ContentParsing\Shikimori\Utils;
use App\Entity\Article;
use App\Entity\ArticleSourcePage;
use App\Entity\Genre;
use Doctrine\Persistence\ManagerRegistry;

class Content
{
    private $managerRegistry;
    private $aspRepo;
    private $genreRepo;
    private $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
        $this->aspRepo = $this->managerRegistry->getRepository(ArticleSourcePage::class);
        $this->genreRepo = $this->managerRegistry->getRepository(Genre::class);
        $this->manager = $this->managerRegistry->getManager();
    }

    public function run($count): array
    {
        $result = [];
        for ($p = 0; $p < $count; $p++) {
            $asp = $this->selectArticleSourcePage();
            if ($asp) {
                try {
                    $article = $this->loadArticleSourcePage($asp);
                    $this->manager->persist($asp);
                    $this->manager->persist($article);
                    $result[] = $article;
                } catch (\Exception $ex) {
                    dump($ex);
                }
            } else {
                break;
            }
        }
        $this->manager->flush();
        return $result;
    }

    private function selectArticleSourcePage(): ArticleSourcePage
    {
        $aspList = $this->aspRepo->getForScanning(1);
        return $aspList[0];
    }

    private function loadArticleSourcePage(ArticleSourcePage $asp):Article
    {
        $contentLoader = new ContentLoader();
        $loadedData = $contentLoader->load($asp->getUrl());

        if (!$loadedData) {
            throw new \Exception('Failed to load content');
        }

        $article = $asp->getArticle();
        if (!$article) {
            $article = new Article();
            $article->setSourcePage($asp);
            $article->setType($asp->getType());
        }

        if (isset($loadedData['description'])) {
            $article->setName($loadedData['name']);
        }
        if (isset($loadedData['description'])) {
            $article->setDescription($loadedData['description']);
        }
        if (isset($loadedData['description'])) {
            $article->setScores($loadedData['scores']);
        }
        if (isset($loadedData['description'])) {
            $article->setPosterUrl($loadedData['poster']);
        }

        //$article->setName($loadedData['details']['type']); // TODO "type" => "TV Сериал"
        if (isset($loadedData['details']['episodes'])) {
            $article->setEpisodes($loadedData['details']['episodes']);
        }
        if (isset($loadedData['details']['episode_duration'])) {
            $article->setEpisodeDuration($loadedData['details']['episode_duration']);
        }
        if (isset($loadedData['details']['age_rating'])) {
            $article->setAgeRating($loadedData['details']['age_rating']);
        }
        if (isset($loadedData['details']['license'])) {
            $article->setLicense($loadedData['details']['license']);
        }
        if (isset($loadedData['details']['premiere'])) {
            $article->setPremiereDate(Utils::StrToDate($loadedData['details']['premiere']));
        }
        if (isset($loadedData['details']['status_tag'])) {
            $article->setStatus($loadedData['details']['status_tag']);
        }
        if (isset($loadedData['details']['genres'])) {
            foreach ($loadedData['details']['genres'] as $genreName) {
                $article->addGenre($this->genreRepo->retrieveByName($genreName));
            }
        }
        // $article->setYear(); TODO
        if (!$article->getUriAlias()) {
            $uriAlias = $article->generateUriAlias();
            $article->setUriAlias($uriAlias);
        }

        $asp->setLastScanTime(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));

        return $article;
    }

}