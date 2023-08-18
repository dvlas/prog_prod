<?php

namespace App\Models;

class FilmModel
{
    private string $title;
    private string $year;
    private string $img;
    private string $rating;

    /**
     * @param string $title
     * @param string $year
     * @param string $img
     * @param string $rating
     */
    public function __construct(string $title, string $year, string $img, string $rating)
    {
        $this->title = $title;
        $this->year = $year;
        $this->img = $img;
        $this->rating = $rating;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * @param string $year
     */
    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg(string $img): void
    {
        $this->img = $img;
    }

    /**
     * @return string
     */
    public function getRating(): string
    {
        return $this->rating;
    }

    /**
     * @param string $rating
     */
    public function setRating(string $rating): void
    {
        $this->rating = $rating;
    }
}