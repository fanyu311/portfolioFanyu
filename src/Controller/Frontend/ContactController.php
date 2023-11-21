<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('contact', name: 'app.contact')]
    public function index(): Response
    {
        return $this->render('Frontend/Contact/index.html.twig');
    }
}
