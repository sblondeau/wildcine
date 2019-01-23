<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\MovieRepository;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search-form", name="search")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(SearchType::class);

        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/search/{search}", name="search_result")
     */
    public function search(MovieRepository $movieRepository, PersonRepository $personRepository, string $search = null)
    {
        if ($search) {
            $movies = $movieRepository->findByInput($search);
            $persons = $personRepository->findByInput($search);

            return $this->render('search/results.html.twig', [
                'movies'  => $movies ?? [],
                'persons' => $persons ?? [],
            ]);
        }

        return new Response();


    }
}
