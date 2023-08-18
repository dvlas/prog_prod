<?php

namespace App\Service\Parser;

use App\Interfaces\AbstractParserFilms;
use App\Models\FilmModel;
use Symfony\Component\DomCrawler\Crawler;

class KinoNews extends AbstractParserFilms
{
    private string $url = "https://www.kinonews.ru/top100";
    private function parser($num_page)
    {
        $url = $this->generateUrl($num_page);
        $html = $this->getHtml($url);

        $crowler = new Crawler($html);
        $blockPageNew = $crowler->filter("#maincolumn > div > div.block-page-new")->children('div')->each(function (Crawler $data){
            $firstSymb = mb_substr( $data->innerText(), 0, 1);
            if($firstSymb === "\n") return null;
            return $data;
        });

        $filterFilms = array_filter($blockPageNew, function (Crawler $elem){
            $blockTitle = $elem;
            $tempTitle = $blockTitle->filter(".bigtext > .titlefilm");
            return !(($tempTitle->count() === 0));
        }, true);

        $elements = array_map(function (Crawler $value){
            $img = $this->url.$value->filter('img')->attr('src');
            $title = $value->filter(".titlefilm")->text();
            $rating = $value->filter(".rating-big")->text();
            $tempBigText = $value->filter(".bigtext")->html();
            $year = mb_substr(
                $tempBigText,
                -4
            );
            return new FilmModel($title, $year, $img, $rating);
        }, $filterFilms);
        return $elements;
    }
    /**
     * @return array< FilmModel>
     * @var int $num_page
     */
    public function getDataListForPage(int $num_page): array
    {
        return $this->parser($num_page);
    }

    /**
     *   @return array<FilmModel>
     */
    public function getList() : array
    {
        $filmModel = new FilmModel();
        return [$filmModel];
    }

    private function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    private function generateUrl($page)
    {
        $url = $this->url.'_p'.$page;
        if(!$page || $page === 1)
        {
            return $this->url;
        }
        return $url;
    }
}