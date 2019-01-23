<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    /**
     * @Route("/person/{id<\d+>}", name="person")
     */
    public function show(int $id, PersonRepository $personRepository)
    {
        $person = $personRepository->findOneByPerson($id);

        return $this->render('person/show.html.twig', [
            'person' => $person,
        ]);
    }
}
