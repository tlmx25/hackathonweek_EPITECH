<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class InfosController extends AbstractController
{
    private string $api_base_url;
    private $dataFile;
    private $dictionary;

    public function __construct()
    {
        $this->api_base_url = getenv("API_BASE_URL");
        $data = file_get_contents($this->api_base_url, false, stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => [
                    'Accept: application/json',
                    'Content-type: application/json'
                ]
            ]
        ]));
        $this->dataFile = json_decode($data, true);
        $this->dictionary = [
            "pole_ai" => "Pôle AI",
            "pole_walker" => "Pôle Walker",
            "team_it" => "Team IT",
            "team_rocket" => "Team Rocket",
            "pole_cousteau" => "Pôle Cousteau ",
            "pole_8_6" => "Pôle 8.6",
            "pole_position" => "Pôle Position",
            "bug_buster" => "Bug Buster",
            "team_elephant" => "Team Elephant ",
            "team_eden" => "Team Eden",
            "studio_design" => "Studio Design",
            "pole_passe_partout" => "Pôle Passe Partout ",
            "pole_griffondor" => "Pôle Griffondor",
            "team_dev" => "Team Dev"
        ];
    }

    private function filterMembers(string $field, string $fieldToCompare)
    {
        return array_filter($this->dataFile, function ($element) use ($field, $fieldToCompare) {
            return trim($element[$field]) == trim($fieldToCompare);
        });
    }

    #[Route('/pictures', name: 'app_pictures', methods: "GET")]
    public function index(): Response
    {
        return new JsonResponse($this->dataFile);
    }

    #[Route('/pictures/post/{post}', name: 'app_pictures_post', methods: "GET")]
    public function getPicturesByPost(string $post): Response
    {
        return new JsonResponse($this->filterMembers("poste", $post));
    }

    #[Route('/pictures/team/{team}', name: 'app_pictures_team', methods: "GET")]
    public function getPicturesByTeam(string $team): Response
    {
        return new JsonResponse($this->filterMembers("equipe", $this->dictionary[$team]));
    }

    #[Route('/pictures/agency/{agency}', name: 'app_pictures_agency', methods: "GET")]
    public function getPicturesByAgency(string $agency): Response
    {
        return new JsonResponse($this->filterMembers("agence", $agency));
    }
}
