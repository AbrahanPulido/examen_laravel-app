<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class NewsApiService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getArticles($page)
    {
        $apiKey = env('NEWS_API_KEY');
        $perPage = 10;

        $url = "https://newsapi.org/v2/top-headlines?country=us&page=$page&pageSize=$perPage&apiKey=$apiKey";

        try {
            $response = $this->client->get($url);
            $data = json_decode($response->getBody(), true);
            return $data['articles'] ?? [];
        } catch (GuzzleException $e) {
            // Handle exception
            return [];
        }
    }
}
