<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use App\Repository\StageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="ProStage_accueil")
     */
    public function index(StageRepository $reposStage): Response
    {
        $stages = $reposStage->findAll();

        return $this->render(
            'pro_stage/index.html.twig',
            ['stages' => $stages]
        );
    }

    /**
     * @Route("/entreprises", name="ProStage_entreprises")
     */
    public function afficherEntreprises(EntrepriseRepository $reposEntrep): Response
    {
        $entreprises = $reposEntrep->findAll();

        return $this->render(
            'pro_stage/afficherEntreprises.html.twig',
            ['entreprises' => $entreprises]
        );
    }

    /**
     * @Route("/formations", name="ProStage_formations")
     */
    public function afficherFormations(): Response
    {

        return $this->render(
            'pro_stage/afficherFormations.html.twig'
        );
    }

    /**
     * @Route("/stages/{id}", name="ProStage_stage")
     */
    public function afficherDetailStage($id): Response
    {

        return $this->render(
            'pro_stage/affichageDetailStage.html.twig',
            ['idRessource' => $id]
        );
    }

    /**
     * @Route("/entreprise/{id}", name="ProStage_detail_entreprise")
     */
    public function afficherDetailEntreprise($id)
    {
        return $this->render(
            'pro_stage/affichageDetailEntreprise.html.twig',
            ['id' => $id]
        );
    }
}
