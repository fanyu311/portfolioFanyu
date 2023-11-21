<?php

namespace App\Controller\Backend;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;


#[Route('/admin/projets', name: 'admin.projets')]
class ProjetController extends AbstractController
{
    public function __construct(
        private ProjetRepository $projetRepo,
    ) {
    }

    #[Route('', name: '.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('Backend/Projet/index.html.twig', [
            'projets' => $this->projetRepo->findAll(),
        ]);
    }

    #[Route('/create', name: '.create', methods: ['POST', 'GET'])]
    public function create(Request $request): Response
    {
        $projet = new Projet();

        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->projetRepo->save($projet);

            $this->addFlash('success', 'Projet créé avec succès');

            return $this->redirectToRoute('admin.projets.index');
        }

        return $this->render('Backend/Projet/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: '.edit', methods: ['GET', 'POST'])]
    public function edit(?Projet $projet, Request $request): Response
    {
        // On vérifie que l'article est bien trouvé
        if (!$projet instanceof Projet) {
            $this->addFlash('error', 'Projet non trouvé');

            return $this->redirectToRoute('admin.projets.index');
        }

        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->projetRepo->save($projet);

            $this->addFlash('success', 'Projet mis à jour avec succès');

            return $this->redirectToRoute('admin.projets.index');
        }

        return $this->render('Backend/Projet/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/delete', name: '.delete', methods: ['POST'])]
    public function delete(Request $request): RedirectResponse
    {
        $projet = $this->projetRepo->find($request->get('id', 0));

        if (!$projet instanceof Projet) {
            $this->addFlash('error', 'Projet non trouvé');

            return $this->redirectToRoute('admin.projets.index', [], 404);
        }

        if ($this->isCsrfTokenValid('delete' . $projet->getId(), $request->get('token'))) {
            $this->projetRepo->remove($projet);

            $this->addFlash('success', 'Projet supprimé avec succès');

            return $this->redirectToRoute('admin.projets.index');
        }

        $this->addFlash('error', 'Token invalid');

        return $this->redirectToRoute('admin.projets.index');
    }
}
