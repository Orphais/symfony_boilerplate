<?php

namespace App\Controller;

use App\Repository\OignonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OignonController extends AbstractController
{
    #[Route('/oignon', name: 'oignons_list')]
    public function index(OignonRepository $oignonRepository): Response
    {
        $oignons = $oignonRepository->findAll();

        $oignons2 = [];
        for ($i = 0; $i < count($oignons); $i++) {
            $oignons2[] = [$oignons[$i], $oignons[$i]->getBurgers()];
        }

        return $this->render('pages/oignons_list.html.twig', [
            'oignons2' => $oignons2,
        ]);
    }
}
