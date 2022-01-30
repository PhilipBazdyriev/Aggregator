<?php

namespace App\ContentParsing\Shikimori;

use App\Entity\Article;
use GuzzleHttp\Client;

class ListingLoader
{

    private $type;

    /**
     * @var Client
     */
    private $client;

    /**
     *
     * @param $type manga|anime
     * @throws \Exception
     */
    public function __construct($type)
    {
        if ($type == Article::ANIME) {
            $this->type = 'animes';
        }
        elseif ($type == Article::MANGA) {
            $this->type = 'mangas';
        }
        else {
            throw new \Exception('Wrong type!');
        }
        $this->client = new Client([
            'verify' => false
        ]);
        //$this->client->set('verify', false);
    }

    public function loadPage($page)
    {
        $uri = $this->buildPageUri($this->type, $page);
        $response = $this->client->request('GET', $uri);
        $content = $response->getBody()->getContents();
        $parsed_data = json_decode($content, true);

        $htmlRaw = $parsed_data['content'];
        $htmlDom = new \DOMDocument();
        @$htmlDom->loadHTML($htmlRaw);
        $anchorTags = $htmlDom->getElementsByTagName('a');

        $links = [];
        foreach($anchorTags as $anchorTag){

            $href = $anchorTag->getAttribute('href');
            //$title = $anchorTag->getAttribute('title');
            $links[] = $href;
            //dump('href: ' . $href . ' / title: ' . $title);
        }
        return $links;
    }

    /**
     * @param $type mangas|animes
     * @param $page
     * @return string
     */
    private function buildPageUri($type, $page): string
    {
        $url = 'https://shikimori.one/' . $type . '/order-by/id_desc/page/' . $page . '.json';
        return $url;
    }

}