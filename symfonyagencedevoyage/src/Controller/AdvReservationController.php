<?php

namespace App\Controller;

use App\Entity\AdvReservation;
use App\Form\AdvReservationType;
use App\Repository\AdvReservationRepository;
use App\Repository\AdvStatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/reservation', name: 'app_adv_reservation_')]
class AdvReservationController extends AbstractController
{
    #[Route('s', name: 'index', methods: ['GET'])]
    public function index(AdvReservationRepository $advReservationRepository, AdvStatutRepository $advStatutRepository): Response
    {

        $statut = $advStatutRepository->findAll();


        return $this->render('adv_reservation/index.html.twig', [
            'adv_reservations' => $advReservationRepository->findAll(),
            'user' => $this->getUser(),
            'statut' => $statut
        ]);
    }

    #[Route('s', name: 'editStatut', methods: ['POST'])]
    public function editStatut(AdvReservationRepository $advReservationRepository, AdvStatutRepository $advStatutRepository, Request $request, ValidatorInterface $validatorInterface, EntityManagerInterface $em): Response
    {

        $content = $request->getContent();
        $idStatut = substr($content, -1);
        $idResa = substr($content, 0, 1);
        $reservation = $advReservationRepository->findOneBy(['id' => $idResa]);
        $statut = $advStatutRepository->findOneBy(["id" => $idStatut]);
        $reservation->setStatut($statut);


        $errors = $validatorInterface->validate($reservation);

        if ($errors->count()) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }
            return $this->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('app_adv_reservation_index', [], Response::HTTP_SEE_OTHER);
        }
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $advReservation = new AdvReservation();
        $form = $this->createForm(AdvReservationType::class, $advReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($advReservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_adv_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adv_reservation/new.html.twig', [
            'adv_reservation' => $advReservation,
            'form' => $form,
            'user' => $this->getUser()
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(AdvReservation $advReservation): Response
    {
        return $this->render('adv_reservation/show.html.twig', [
            'adv_reservation' => $advReservation,
            'user' => $this->getUser()
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AdvReservation $advReservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdvReservationType::class, $advReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adv_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adv_reservation/edit.html.twig', [
            'adv_reservation' => $advReservation,
            'form' => $form,
            'user' => $this->getUser()
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, AdvReservation $advReservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $advReservation->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($advReservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adv_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
