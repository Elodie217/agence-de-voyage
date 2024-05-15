<?php

namespace App\Controller\Api;

use App\Controller\UserController;
use App\Entity\AdvReservation;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\AdvStatutRepository;
use App\Repository\AdvVoyageRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/reservation', name: 'api_reservation_')]
class ReservationController extends AbstractController
{

    #[Route('/new', name: 'new', methods: ['POST'])]
    public function new(Request $request, UserRepository $userRepository, AdvVoyageRepository $advVoyageRepository, AdvStatutRepository $advStatutRepository, ValidatorInterface $validatorInterface, EntityManagerInterface $em)
    {
        $content = $request->getContent();
        $reservationUser = json_decode($content, true);



        if ($userRepository->findOneBy(["email" => $reservationUser['email'], "nom_utilisateur" => $reservationUser['nom_utilisateur'], "telephone_utilisateur" => $reservationUser['tel_utilisateur']])) {
            // ici l'utilisateur existe déjà
            $user = $userRepository->findOneBy(["email" => $reservationUser['email'], "nom_utilisateur" => $reservationUser['nom_utilisateur'], "telephone_utilisateur" => $reservationUser['tel_utilisateur']]);
        } else {
            // ici l'uilisateur n'existe pas, alors on le créer
            $user = new User;
            $user->setEmail(htmlspecialchars($reservationUser['email']));
            $user->setNomUtilisateur(htmlspecialchars($reservationUser['nom_utilisateur']));
            $user->setPrenomUtilisateur(htmlspecialchars($reservationUser['prenom_utilisateur']));
            $user->setTelephoneUtilisateur(htmlspecialchars($reservationUser['tel_utilisateur']));


            $errors = $validatorInterface->validate($user);

            if ($errors->count()) {
                $messages = [];
                foreach ($errors as $error) {
                    $messages[] = $error->getMessage();
                }

                return $this->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                $em->persist($user);
                $em->flush();

                $user = $userRepository->findOneBy(["email" => $reservationUser['email'], "nom_utilisateur" => $reservationUser['nom_utilisateur'], "telephone_utilisateur" => $reservationUser['tel_utilisateur']]);
            }
        };

        $voyage = $advVoyageRepository->findOneBy(["id" => htmlspecialchars($reservationUser['adv_voyage_id'])]);
        $statut = $advStatutRepository->findOneBy(["id" => 1]);

        $reservation = new AdvReservation;
        $reservation->setUser($user);
        $reservation->setAdvVoyage($voyage);
        $reservation->setMessageReservation(htmlspecialchars($reservationUser['message_reservation']));
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

            return $this->json('Votre message a été envoyé.', Response::HTTP_CREATED);
        }
    }
}
