<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="ProStage_accueil")
     */
    public function index(): Response
    {
        return $this->render('pro_stage/index.html.twig');
    }

    /**
     * @Route("/entreprises", name="ProStage_entreprises")
     */
    public function afficherEntreprises(): Response
    {
        
        return $this->render('pro_stage/afficherEntreprises.html.twig');
    }

    /**
     * @Route("/formations", name="ProStage_formations")
     */
    public function afficherFormations(): Response
    {
        
        return $this->render('pro_stage/afficherFormations.html.twig');
    }

    /**
     * @Route("/stages/{id}", name="ProStage_stage")
     */
    public function afficherDetailStage($id): Response
    {
        
        return $this->render('pro_stage/affichageDetailStage.html.twig',
        ['idRessource' => $id]);
    }
}
