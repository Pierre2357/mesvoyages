<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur de la page voyages
 *
 * @author leber
 */
class VoyagesController extends AbstractController {
    
    #[Route('/voyages', name: 'voyages')]
    public function index(): Response{
        return $this->render("pages/voyages.html.twig");
    }
    
}