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
    private mixed $dataFile;
    private array $dictionary;

    public function __construct()
    {
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
    }

    #[Route('/infos', name: 'app_infos', methods: "GET")]
    public function index(): Response
    {
        return new JsonResponse($this->dataFile);
    }

    #[Route('/infos/posts', name: 'app_infos_posts', methods: "GET")]
    public function getInfosPosts(): Response
    {
        return new JsonResponse($this->getUniqueData("poste"));
    }

    #[Route('/infos/post/{post}', name: 'app_infos_post', methods: "GET")]
    public function getInfosByPost(string $post): Response
    {
        return new JsonResponse($this->filterMembers("poste", $post));
    }

    #[Route('/infos/teams', name: 'app_infos_create_member', methods: "GET")]
    public function getInfosTeams(): Response
    {
        return new JsonResponse($this->getUniqueData("equipe"));
    }

    #[Route('/infos/team/{team}', name: 'app_infos_team', methods: "GET")]
    public function getInfosByTeam(string $team): Response
    {
        return new JsonResponse($this->filterMembers("equipe", $this->dictionary[$team]));
    }

    #[Route('/infos/agency/{agency}', name: 'app_infos_agency', methods: "GET")]
    public function getInfosByAgency(string $agency): Response
    {
        return new JsonResponse($this->filterMembers("agence", $agency));
    }

    #[Route('/infos/agency', name: 'app_infos_agency', methods: "GET")]
    public function getInfosAgency(): Response
    {
        return new JsonResponse($this->getUniqueData("agence"));
    }
}
