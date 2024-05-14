<?php

namespace App\Controller\Api;

use App\Entity\AdvVoyage;
use App\Repository\AdvVoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/voyage', name: 'api_voyage_')]
class VoyageController extends AbstractController
{

    #[Route('s', name: 'index', methods: ['GET'])]
    public function index(AdvVoyageRepository $advVoyageRepository): JsonResponse
    {
        $Voyage = $advVoyageRepository->findAll();
        return $this->json($Voyage, context: ['groups' => 'api_voyage_index']);
    }

    // #[Route('/parameters', name: 'parameters')]
    // public function categorie(Request $request, AdvVoyageRepository $advVoyageRepository): JsonResponse
    // {
    //     $content = $request->getContent();
    //     $parametres = json_decode($content, true);
    //     $Voyage = $advVoyageRepository->findAllByParameters($parametres['categorie'], $parametres['pays']);
    //     return $this->json($Voyage, context: ['groups' => 'api_voyage_index']);
    // }

    #[Route('/parameters', name: 'parameters')]
    public function categorie(Request $request, AdvVoyageRepository $advVoyageRepository): JsonResponse
    {
        $content = $request->getContent();
        $parametres = json_decode($content, true);
        $Voyage = $advVoyageRepository->findAllByParameters($parametres['categorie'], $parametres['pays'], $parametres['ordre'], $parametres['dureeVoyage']);
        return $this->json($Voyage, context: ['groups' => 'api_voyage_index']);
    }

    #[Route('/derniers', name: 'derniers')]
    public function dernier(AdvVoyageRepository $advVoyageRepository): JsonResponse
    {
        $Voyage = $advVoyageRepository->dernierVoyages();
        return $this->json($Voyage, context: ['groups' => 'api_voyage_index']);
    }


    #[Route('/{id}', name: 'show')]
    public function show(AdvVoyage $advVoyage): JsonResponse
    {
        return $this->json($advVoyage, context: ['groups' => 'api_voyage_index']);
    }
}
