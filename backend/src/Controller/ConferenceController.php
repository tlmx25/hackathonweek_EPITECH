<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ConferenceController extends AbstractController
{
    #[Route('/auth', name: 'app_conference')]
    public function index(): Response
    {
        $data = ['message' => 'Hello, this is your API response!'];

        // Create a JsonResponse and return it
        return new JsonResponse($data);
    }
}
