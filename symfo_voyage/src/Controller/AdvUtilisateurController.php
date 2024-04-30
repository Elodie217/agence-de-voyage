<?php

namespace App\Controller;

use App\Entity\AdvUtilisateur;
use App\Form\AdvUtilisateurType;
use App\Repository\AdvUtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/adv/utilisateur', name: 'app_adv_utilisateur_')]
class AdvUtilisateurController extends AbstractController
{


    #[Route('s', name: 'index', methods: ['GET'])]
    public function index(AdvUtilisateurRepository $advUtilisateurRepository): Response
    {
        return $this->render('adv_utilisateur/index.html.twig', [
            'adv_utilisateurs' => $advUtilisateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $advUtilisateur = new AdvUtilisateur();
        $form = $this->createForm(AdvUtilisateurType::class, $advUtilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($advUtilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_adv_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adv_utilisateur/new.html.twig', [
            'adv_utilisateur' => $advUtilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(AdvUtilisateur $advUtilisateur): Response
    {
        return $this->render('adv_utilisateur/show.html.twig', [
            'adv_utilisateur' => $advUtilisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AdvUtilisateur $advUtilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdvUtilisateurType::class, $advUtilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adv_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adv_utilisateur/edit.html.twig', [
            'adv_utilisateur' => $advUtilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, AdvUtilisateur $advUtilisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $advUtilisateur->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($advUtilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adv_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
