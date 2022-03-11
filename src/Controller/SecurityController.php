<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
    }

    /**
     * @Route("/signin", name="app_signin")
     */
    public function signin(Request $request, EntityManagerInterface $manager): Response
    {
        $user = new User();

        $formInscription = $this->createForm(UserType::class, $user);

        $formInscription->handleRequest($request);

        if ($formInscription->isSubmitted()) {
            return $this->redirectToRoute('ProStage_accueil');
        }
        return $this->render(
            "security/signin.html.twig",
            ["formInscription" => $formInscription->createView()]
        );
    }
}
