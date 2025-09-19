<?php

namespace App\Controller;

use App\Repository\SauceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SauceController extends AbstractController
{
    #[Route('/sauce', name: 'sauces_list')]
    public function index(SauceRepository $sauceRepository): Response
    {
        $sauces = $sauceRepository->findAll();

        $sauces2 = [];
        for ($i = 0; $i < count($sauces); $i++) {
            $sauces2[] = [$sauces[$i], $sauces[$i]->getBurgers()];
        }

        return $this->render('pages/sauces_list.html.twig', [
            'sauces2' => $sauces2,
        ]);
    }
}
