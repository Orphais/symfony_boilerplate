<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Repository\BurgerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BurgerController extends AbstractController
{
    #[Route('/burgers', name: 'burgers_list')]
    public function list(BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findAll();

        return $this->render('pages/burgers_list.html.twig', [
            'burgers' => $burgers,
        ]);
    }

    #[Route('/burger/{id}', name: 'burger_show')]
    public function show(int $id, BurgerRepository $burgerRepository): Response
    {
        $burger = $burgerRepository->find($id);

        return $this->render('pages/burger.html.twig', [
            'burger' => $burger,
        ]);
    }
}