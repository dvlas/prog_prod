<?php

namespace App\Interfaces;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

abstract class AbstractParserFilms implements ParserInterface
{
    protected readonly HttpClientInterface $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::create();
    }

    public function getHtml(string $url)
    {
        if(!$url)
        {
            throw new \Exception("Не передан url");
        }
        $dataHtml = $this->httpClient->request(
            'GET',
            $url
        );
        return $dataHtml->getContent();
    }
}