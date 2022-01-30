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
        try {
            return $this->filter($selector)->text();
        } catch (\Exception $ex) {
            return '';
        }
    }

    public function html($selector): string
    {
        try {
            return $this->filter($selector)->html();
        } catch (\Exception $ex) {
            return '';
        }
    }

    public function imageUrl($selector): string
    {
        try {
            return $this->filter($selector)->attr('src');
        } catch (\Exception $ex) {
            return '';
        }
    }


}