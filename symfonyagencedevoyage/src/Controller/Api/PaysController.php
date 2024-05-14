<?php

namespace App\Controller\Api;

use App\Entity\AdvVoyage;
use App\Repository\AdvPaysRepository;
use App\Repository\AdvVoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/pays', name: 'api_pays_')]
class PaysController extends AbstractController
{

    #[Route('', name: 'index')]
    public function index(AdvPaysRepository $advPaysRepository): JsonResponse
    {
        $Pays = $advPaysRepository->findAll();
        return $this->json($Pays, context: ['groups' => 'api_pays_index']);
    }
}
