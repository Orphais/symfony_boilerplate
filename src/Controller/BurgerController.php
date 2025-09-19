<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Repository\BurgerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BurgerController extends AbstractController
{
    #[Route('/burger', name: 'burgers_list')]
    public function list(Request $request, BurgerRepository $burgerRepository): Response
    {
        $search = $request->query->get('search');
        $searchPrice = $request->query->get('searchPrice');

        $burgers = $burgerRepository->findAll();

        if ($search) {
            $burgers = $burgerRepository->findBurgerWithIngredient($search);
        }

        if ($searchPrice) {
            $burgers = $burgerRepository->findTopXBurgers($searchPrice);
        }

        return $this->render('pages/burgers_list.html.twig', [
            'burgers' => $burgers,
        ]);
    }

    #[Route('/burger/{id}', name: 'burger_show', requirements: ['id' => '\d+'])]
    public function show(int $id, BurgerRepository $burgerRepository): Response
    {
        $burger = $burgerRepository->find($id);

        if ($burger === null) {

            $this->addFlash('error', 'Burger inexistant.');
            return $this->redirectToRoute('burgers_list');
        }

        return $this->render('pages/burger.html.twig', [
            'burger' => $burger,
        ]);
    }

    #[Route('/burger-oignon', name: 'burger_show_oignon')]
    public function showWithOignon(BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findWithOignons();

        // dd($burgers);

        $this->addFlash('info', 'Burger avec oignons.');

        return $this->render('pages/burgers_list.html.twig', [
            'burgers' => $burgers,
        ]);
    }

    #[Route('/burger-top-5', name: 'burger_show_top_5')]
    public function showTop5(BurgerRepository $burgerRepository): Response
    {
        $burgers = $burgerRepository->findBy([], ['price' => 'DESC'], 5);

        // dd($burgers);

        $this->addFlash('info', 'Top 5 des burgers les plus chers.');

        return $this->render('pages/burgers_list.html.twig', [
            'burgers' => $burgers,
        ]);
    }
}