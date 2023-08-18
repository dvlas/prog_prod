<?php

namespace App\Controller;

use App\Entity\Film;
use App\Service\FilmService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(FilmService $service) : Response
    {
//        $film = new Film();
//        $film->setTitle("1212122");
//        $film->setYear("2001");
//        $film->setRating("10");
//        $film->setImg("/img/1.img");
//        $service->save($film);
        return $this->render('films/index.html.twig');
    }
}