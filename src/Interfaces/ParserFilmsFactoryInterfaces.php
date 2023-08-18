<?php

namespace App\Interfaces;

interface ParserFilmsFactoryInterfaces
{
    const TYPE_FILMS = "App\\Service\\Parser\\";
    public function build(string $type);
}