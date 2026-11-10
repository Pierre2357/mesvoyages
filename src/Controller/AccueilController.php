<?php

namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controlleur de la page d'accueil
 *
 * @author leber
 */
class AccueilController extends AbstractController {
    
    /**
     * 
     * @var VisiteRepository
     */
    private $repository;
    
    /**
     * 
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository) {
        $this->repository = $repository;
    }
    
    #[Route('/', name: 'accueil')]
    public function index(): Response{
        $visites = $this->repository->findByTwoMoreRecents();
        return $this->render("pages/accueil.html.twig", [
            'visites' => $visites
        ]);
    }
    
}
