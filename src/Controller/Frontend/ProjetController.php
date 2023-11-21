<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjetRepository;


#[Route('/projets', name: 'app.projets')]
class ProjetController extends AbstractController
{
    public function __construct(
        private ProjetRepository $repo,
    ) {
    }
    #[Route('', name: '.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('Frontend/Projet/show.html.twig', [
            'projets' => $this->repo->findAll(),
        ]);
    }

    #[Route('/detail', name: '.detail', methods: ['GET', 'POST'])]
    public function detail(): Response
    {
        return $this->render('Frontend/Projet/detail.html.twig', [
            'projets' => $this->repo->findAll(),
        ]);
    }
}
