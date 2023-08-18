<?php

namespace App\Service;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;

class FilmService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function save(Film $film)
    {
        $this->em->persist($film);
        $this->em->flush();
    }
}