<?php

namespace App\Controller;

use App\Repository\EmployeeRepository;
use App\Utils\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class InfosController extends AbstractController
{
    private string $api_base_url;
    private array $dictionary;
    private Utils $utils;
    private EmployeeRepository $employeeRepository;
    private array $dataFromDB;

    public function __construct(
        Utils $utils,
        EmployeeRepository $employeeRepository
    )
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
        $this->utils = $utils;
        $this->employeeRepository = $employeeRepository;
        $this->dataFromDB = $this->employeeRepository->findAll();
    }

    #[Route('/infos', name: 'app_infos', methods: "GET")]
    public function index(): Response
    {
        $finalData = [];

        foreach ($this->dataFromDB as $elem) {
            $finalData[] = [
                "id" => $elem->getId(),
                "name" => $elem->getName(),
                "lastName" => $elem->getLastName(),
                "job" => strtolower(trim($elem->getJob())),
                "team" => strtolower(trim($elem->getTeam())),
                "agency" => strtolower(trim($elem->getAgency())),
                "proImage" => $elem->getProImage(),
                "funImage" => $elem->getFunImage(),
            ];
        }
        return new JsonResponse($finalData);
    }

    #[Route('/infos/posts', name: 'app_infos_posts', methods: "GET")]
    public function getInfosPosts(): Response
    {
        return new JsonResponse($this->utils->getUniqueData($this->dataFromDB, "job"));
    }

    #[Route('/infos/post/{post}', name: 'app_infos_post', methods: "GET")]
    public function getInfosByPost(string $post): Response
    {
        return new JsonResponse($this->utils->filterMembers($this->dataFromDB ,"job", $post));
    }

    #[Route('/infos/teams', name: 'app_infos_create_member', methods: "GET")]
    public function getInfosTeams(): Response
    {
        return new JsonResponse($this->utils->getUniqueData($this->dataFromDB ,"team"));
    }

    #[Route('/infos/team/{team}', name: 'app_infos_team', methods: "GET")]
    public function getInfosByTeam(string $team): Response
    {
        return new JsonResponse($this->utils->filterMembers($this->dataFromDB ,"team", $this->dictionary[$team]));
    }

    #[Route('/infos/agencies', name: 'app_infos_agency', methods: "GET")]
    public function getInfosAgencies(): Response
    {
        return new JsonResponse($this->utils->getUniqueData($this->dataFromDB ,"agency"));
    }

    #[Route('/infos/agency/{agency}', name: 'app_infos_agency', methods: "GET")]
    public function getInfosByAgency(string $agency): Response
    {
        return new JsonResponse($this->utils->filterMembers($this->dataFromDB ,"agency", $agency));
    }
}
