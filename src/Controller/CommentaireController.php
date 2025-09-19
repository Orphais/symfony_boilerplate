<?php

namespace App\Controller;

use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CommentaireController extends AbstractController
{
    #[Route('/commentaire', name: 'commentaires_list')]
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        $commentaires = $commentaireRepository->findAll();

        return $this->render('pages/commentaires_list.html.twig', [
            'commentaires' => $commentaires,
        ]);
    }
}
