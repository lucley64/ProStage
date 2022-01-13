<?php

namespace App\Controller;

use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;
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
    public function afficherFormations(FormationRepository $reposFormation): Response
    {
        $formations = $reposFormation->findAll();

        return $this->render(
            'pro_stage/afficherFormations.html.twig',
            ['formations' => $formations]
        );
    }

    /**
     * @Route("/stages/{id}", name="ProStage_stage")
     */
    public function afficherDetailStage($id, StageRepository $reposStage): Response
    {

        $stage = $reposStage->find($id);

        return $this->render(
            'pro_stage/affichageDetailStage.html.twig',
            ['stage' => $stage]
        );
    }

    /**
     * @Route("/entreprises/{id}", name="ProStage_detail_entreprise")
     */
    public function afficherDetailEntreprise($id, EntrepriseRepository $reposEntrep): Response
    {
        $entreprise = $reposEntrep->find($id);

        $stages = $this->getDoctrine()->getRepository(Stage::class)->findByEntreprise($entreprise);

        return $this->render(
            'pro_stage/affichageDetailEntreprise.html.twig',
            [
                'entreprise' => $entreprise,
                'stages' => $stages
            ]
        );
    }

    /**
     * @Route("/formation/{id}", name="ProStage_detail_formation")
     */
    public function afficherDetailFormation($id, FormationRepository $reposFormation): Response
    {

        $formation = $reposFormation->find($id);



        return $this->render(
            'pro_stage/affichageDetailFormation.html.twig',
            ['formation' => $formation]
        );
    }
}
