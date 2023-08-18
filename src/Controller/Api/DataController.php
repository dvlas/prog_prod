<?php

namespace App\Controller\Api;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
{
    #[Route('api/films/{date?}', name: 'top10films')]
    public function films(
        FilmRepository $filmRepository,
        ?string $date
    ) : Response
    {
        $datetime = date("Y-m-d", strtotime($date));
        if(is_null($date))
        {
            $datetime = date("Y-m-d");
        }
        return $this->json($filmRepository->findByDate(
            $datetime
        ));
    }
}