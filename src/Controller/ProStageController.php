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
        // $stages = $reposStage->findAll();
        $stages = $reposStage->findStagesAvecEntreprises();

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
    public function afficherDetailStage(Stage $stage): Response
    {

        return $this->render(
            'pro_stage/affichageDetailStage.html.twig',
            ['stage' => $stage]
        );
    }

    /**
     * @Route("/entreprises/ajout", name="Prostage_ajout_entreprise")
     */
    public function ajouterEntreprise()
    {
        $entreprise = new Entreprise();

        $formulaireEntreprise = $this->createFormBuilder($entreprise)
            ->add('nom')
            ->add('adresse')
            ->add('activite')
            ->add('site')
            ->getForm();

        return $this->render(
            'pro_stage/formulaireAjoutEntreprise.html.twig',
            [
                'vueFormulaireEntreprise' => $formulaireEntreprise->createView()
            ]
        );
    }

    /**
     * @Route("/entreprises/{id}", name="ProStage_detail_entreprise")
     */
    public function afficherDetailEntreprise(Entreprise $entreprise, StageRepository $reposStage): Response
    {
        // $stages = $reposStage->findByEntreprise($entreprise);
        $stages = $reposStage->findStagesPourUneEntreprise($entreprise->getNom());

        return $this->render(
            'pro_stage/affichageDetailEntreprise.html.twig',
            [
                'entreprise' => $entreprise,
                'stages'     => $stages
            ]
        );
    }

    /**
     * @Route("/formation/{id}", name="ProStage_detail_formation")
     */
    public function afficherDetailFormation(Formation $formation, StageRepository $reposStage): Response
    {

        $stages = $reposStage->findStagesPourUneFormation($formation->getNom());

        return $this->render(
            'pro_stage/affichageDetailFormation.html.twig',
            [
                'formation' => $formation,
                'stages'    => $stages
            ]
        );
    }
}
