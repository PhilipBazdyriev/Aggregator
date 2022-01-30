<?php

namespace App\Tools;

use Goutte\Client;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

class VirtualBrowser
{
    /**
     * @var Client
     */

    private $client;
    /**
     * @var Crawler
     */
    private $crawler;

    public function load($url)
    {
        $this->client = new Client();
        $this->crawler = $this->client->request('GET', $url);

    }

    public function filter($selector): Crawler
    {
        return $this->crawler->filter($selector);
    }

    public function text($selector): string
    {
        return $this->filter($selector)->text();
    }

    public function html($selector): string
    {
        return $this->filter($selector)->html();
    }

    public function imageUrl($selector): string
    {
        return $this->filter($selector)->attr('src');
    }


}