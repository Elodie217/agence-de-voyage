<?php

namespace App\Controller;

use App\Entity\AdvVoyage;
use App\Form\AdvVoyageType;
use App\Repository\AdvCategorieRepository;
use App\Repository\AdvVoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/voyage', name: 'app_adv_voyage_')]
class AdvVoyageController extends AbstractController
{
    #[Route('s', name: 'index', methods: ['GET'])]
    public function index(AdvVoyageRepository $advVoyageRepository, AdvCategorieRepository $categorie): Response
    {
        return $this->render('adv_voyage/index.html.twig', [
            'adv_voyages' => $advVoyageRepository->findAll(),
            'user' => $this->getUser()
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $advVoyage = new AdvVoyage();
        $form = $this->createForm(AdvVoyageType::class, $advVoyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advVoyage->setUser($this->getUser());
            $entityManager->persist($advVoyage);
            $entityManager->flush();

            return $this->redirectToRoute('app_adv_voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adv_voyage/new.html.twig', [
            'adv_voyage' => $advVoyage,
            'user' => $this->getUser(),
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(AdvVoyage $advVoyage): Response
    {
        return $this->render('adv_voyage/show.html.twig', [
            'adv_voyage' => $advVoyage,
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AdvVoyage $advVoyage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdvVoyageType::class, $advVoyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adv_voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adv_voyage/edit.html.twig', [
            'adv_voyage' => $advVoyage,
            'user' => $this->getUser(),
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, AdvVoyage $advVoyage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $advVoyage->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($advVoyage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adv_voyage_index', [], Response::HTTP_SEE_OTHER);
    }
}
