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
        //request to the api for get json

        $api_base_url = getenv("API_BASE_URL");

        $data = file_get_contents($api_base_url . '/pictures', false, stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => [
                    'Accept: application/json',
                    'Content-type: application/json'
                ]
            ]
        ]));

        $data = json_decode($data, true);
        // Create a JsonResponse and return it
        return new JsonResponse($data);
    }
}
