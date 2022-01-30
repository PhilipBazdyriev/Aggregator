<?php

namespace App\ContentParsing\Shikimori;

use App\Entity\ArticleSourcePage;
use App\Tools\VirtualBrowser;
use Symfony\Component\DomCrawler\Crawler;

class ContentLoader
{

    public function load(ArticleSourcePage $asp): array
    {

        dump($asp->getUrl());
        $browser = new VirtualBrowser();
        $browser->load($asp->getUrl());

        $title = $browser->text('h1');
        $descriptionRu = $browser->text('.c-description .russian .b-text_with_paragraphs');
        $scores = $browser->text('.scores .score-value');
        $poster = $browser->imageUrl('.c-image img');

        $keyMap = [
            'Тип:' => 'type',
            'Эпизоды:' => 'episodes',
            'Длительность эпизода:' => 'episode_duration',
            'Статус:' => 'status',
            'Рейтинг:' => 'age_rating',
            'Лицензировано:' => 'license',
            'Премьера в РФ:' => 'premiere',
            'Жанры:' => 'genres',
        ];
        $details = [];
        $aboutNodes = $browser->filter('.c-about .line-container');
        foreach ($aboutNodes as $aboutNode) {
            try {

                $aboutCrawler = new Crawler();
                $aboutCrawler->add($aboutNode);

                $key = $aboutCrawler->filter('.key')->text();

                if (key_exists($key, $keyMap)) {
                    $internalKey = $keyMap[$key];
                } else {
                    continue;
                }
                if ($internalKey == 'genres') {
                    $genres = [];
                    $genreNodes = $aboutCrawler->filter('.value .b-tag .genre-ru');
                    foreach ($genreNodes as $genreNode) {
                        $genreCrawler = new Crawler();
                        $genreCrawler->add($genreNode);
                        $genreText = $genreCrawler->text();
                        //dump('    genre: ' . $genreText);
                        $genres[] = $genreText;
                    }
                    $details[$internalKey] = $genres;
                }
                elseif ($internalKey == 'status') {
                    $status_tag = $aboutCrawler->filter('.value .b-anime_status_tag')->attr('data-text');
                    //dump('    status_tag: ' . $status_tag);
                    $details['status_tag'] = $status_tag;
                } else {
                    $value = $aboutCrawler->filter('.value')->text();
                    $details[$internalKey] = $value;
                }
            } catch (\Exception $ex) {
                //dump($ex);
            }
        }

        return [
            'title' => $title,
            'description' => $descriptionRu,
            'scores' => $scores,
            'poster' => $poster,
            'details' => $details,
        ];
    }

}