<?php

namespace App\Interfaces;

use Symfony\Contracts\HttpClient\HttpClientInterface;

interface ParserInterface
{
    public function getHtml(string $url);
    public function getDataListForPage(int $num_page);
    public function getList();
}