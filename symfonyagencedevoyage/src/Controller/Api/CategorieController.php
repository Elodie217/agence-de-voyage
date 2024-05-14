<?php

namespace App\Controller\Api;

use App\Entity\AdvCategorie;
use App\Repository\AdvCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/categorie', name: 'api_categorie_')]
class CategorieController extends AbstractController
{

    #[Route('s', name: 'index')]
    public function index(AdvCategorieRepository $advCategorieRepository): JsonResponse
    {
        $Categorie = $advCategorieRepository->findAll();
        return $this->json($Categorie, context: ['groups' => 'api_categorie_index']);
    }
}
