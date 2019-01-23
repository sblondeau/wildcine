<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MovieController
 * @Route("/movie", name="movie_")
 *
 */
class MovieController extends AbstractController
{

    /**
     * @Route("/search/{search}", name="search")
     */
    public function search(string $search, MovieRepository $movieRepository)
    {
        $movies = $movieRepository->findByInput($search);

        return $this->render('movie/index.html.twig', [
            'movies' => $movies,
        ]);
    }


    /**
     * @Route("/{id<\d+>}", name="show")
     */
    public function index(int $id, MovieRepository $movieRepository)
    {
        $movie = $movieRepository->findOneByMovie($id);

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }

}
