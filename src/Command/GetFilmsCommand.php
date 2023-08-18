<?php

namespace App\Command;

use App\Entity\Film;
use App\Factories\ParserFilmsFactory;
use App\Models\FilmModel;
use App\Service\FilmService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DomCrawler\Crawler;

#[AsCommand(
    name: 'app:get-films',
    description: 'Получить список фильмов из сервиса kinonews',
)]
class GetFilmsCommand extends Command
{
    private readonly EntityManagerInterface $em;
    private readonly FilmService $filmService;

    public function __construct(
        EntityManagerInterface $em,
        FilmService $filmService
    ) {
        parent::__construct();
        $this->em = $em;
        $this->filmService = $filmService;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(
        InputInterface $input, OutputInterface $output
    ): int
    {
        $io = new SymfonyStyle($input, $output);

        $parserFilmsFactory = new ParserFilmsFactory();
        $classParser = $parserFilmsFactory->build('KinoNews');

        foreach (range(1,20) as $value){
            $listFilms = $classParser->getDataListForPage($value);
            $filmService = new FilmService($this->em);
            /**
             * @var array<FilmModel> $listFilms
             */
            foreach ($listFilms as $film) {
                $createdAt = new \DateTime();
                $filmEntity = new Film();
                $filmEntity->setTitle($film->getTitle());
                $filmEntity->setRating($film->getRating());
                $filmEntity->setImg($film->getImg());
                $filmEntity->setYear($film->getYear());
                $filmEntity->setCreatedAt($createdAt);
                $filmService->save($filmEntity);
                $io->success('Фильм: '.$film->getTitle().". Успешно загружен!");
            }
            sleep(5);
        }

        $io->success('Все фильмы успешно загружены.');
        return Command::SUCCESS;
    }
}
