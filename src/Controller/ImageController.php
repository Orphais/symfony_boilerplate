<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ImageController extends AbstractController
{
    #[Route('/image', name: 'images_list')]
    public function index(ImageRepository $imageRepository): Response
    {
        $images = $imageRepository->findAll();

        return $this->render('pages/images_list.html.twig', [
            'images' => $images,
        ]);
    }
}
