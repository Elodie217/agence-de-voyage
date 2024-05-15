<?php

namespace App\Controller;

use App\Entity\AdvPays;
use App\Repository\AdvReservationRepository;
use App\Repository\AdvStatutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/adv/pays', name: 'app_adv_pays_')]
class AdvPaysController extends AbstractController
{

    #[Route('/new', name: 'new', methods: ['POST'])]
    public function new(AdvReservationRepository $advReservationRepository, AdvStatutRepository $advStatutRepository, Request $request, ValidatorInterface $validatorInterface, EntityManagerInterface $em): Response
    {
        $content = $request->getContent();
        $pays = substr($content, 5);
        $newpays = new AdvPays;
        $newpays->setNomPays(htmlspecialchars($pays));


        $errors = $validatorInterface->validate($newpays);

        if ($errors->count()) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }
            $this->addFlash('error', $messages);
            return $this->redirectToRoute('app_adv_voyage_new', [], Response::HTTP_SEE_OTHER);
        } else {
            $em->persist($newpays);
            $em->flush();

            $this->addFlash('success', 'Le pays a bien été enregistré.');
            return $this->redirectToRoute('app_adv_voyage_new', [], Response::HTTP_SEE_OTHER);
        }
    }
}
