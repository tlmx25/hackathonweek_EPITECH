<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class InfosController extends AbstractController
{
    #[Route('/pictures', name: 'app_pictures', methods: "GET")]
    public function index(): Response
    {
        $api_base_url = getenv("API_BASE_URL");
        $data = ['message' => 'Hello, this is your API response!'];

        // Create a JsonResponse and return it
        return new JsonResponse($api_base_url);
    }
}
