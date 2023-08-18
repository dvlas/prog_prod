<?php

namespace App\Factories;

use App\Exceptions\TypeClassFilmsException;
use App\Interfaces\ParserFilmsFactoryInterfaces;
use App\Interfaces\ParserInterface;
use App\Service\Parser\KinoNews;
use Symfony\Component\VarExporter\Exception\ClassNotFoundException;

class ParserFilmsFactory implements ParserFilmsFactoryInterfaces
{
    public function build(string $type)
    {
        if(!$type)
        {
            throw new TypeClassFilmsException();
        }
        $classCreateFilm = self::TYPE_FILMS.$type;
        if(!class_exists($classCreateFilm))
        {
            throw new ClassNotFoundException($classCreateFilm);
        }
        return new $classCreateFilm;
    }
}