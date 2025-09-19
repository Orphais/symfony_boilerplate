<?php

namespace App\Controller;

use App\Repository\PainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PainController extends AbstractController
{
    #[Route('/pain', name: 'pains_list')]
    public function index(PainRepository $painRepository): Response
    {
        $pains = $painRepository->findAll();

        $pains2 = [];
        for ($i = 0; $i < count($pains); $i++) {
            $pains2[] = [$pains[$i], $pains[$i]->getBurgers()];
        }

        return $this->render('pages/pains_list.html.twig', [
            'pains2' => $pains2,
        ]);
    }
}
