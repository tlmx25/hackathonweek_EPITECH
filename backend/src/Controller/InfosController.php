<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use App\Utils\Utils;
use Symfony\Component\HttpFoundation\Request;
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
                "job" => trim($elem->getJob()),
                "team" => trim($elem->getTeam()),
                "agency" => trim($elem->getAgency()),
                "proImage" => $elem->getProImage(),
                "funImage" => $elem->getFunImage(),
            ];
        }
        return new JsonResponse($finalData);
    }

    #[Route('/infos/posts', name: 'app_infos_posts', methods: "GET")]
    public function getInfosPosts(): Response
    {
        $this->dataFromDB = $this->employeeRepository->findAll();
        return new JsonResponse($this->utils->getUniqueData($this->dataFromDB, "job"));
    }

    #[Route('/infos/post/{post}', name: 'app_infos_post', methods: "GET")]
    public function getInfosByPost(string $post): Response
    {
        $this->dataFromDB = $this->employeeRepository->findAll();
        return new JsonResponse($this->utils->filterMembers($this->dataFromDB ,"job", $post));
    }

    #[Route('/infos/teams', name: 'app_infos_create_member', methods: "GET")]
    public function getInfosTeams(): Response
    {
        $this->dataFromDB = $this->employeeRepository->findAll();
        return new JsonResponse($this->utils->getUniqueData($this->dataFromDB ,"team"));
    }

    #[Route('/infos/team/{team}', name: 'app_infos_team', methods: "GET")]
    public function getInfosByTeam(string $team): Response
    {
        $this->dataFromDB = $this->employeeRepository->findAll();
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
        $this->dataFromDB = $this->employeeRepository->findAll();
        return new JsonResponse($this->utils->filterMembers($this->dataFromDB ,"agency", $agency));
    }

    #[Route('/infos/employee', name: 'app_infos_employee', methods: "POST")]
    public function postEmployee(Request $request): Response
    {
        $body = json_decode($request->getContent(), true);
        $existingEmployee = $this->employeeRepository->findOneBy(["lastName" => $body["lastName"]]);
        if (!$existingEmployee) {
            $employee = new Employee();
            $employee->setName($body["name"]);
            $employee->setLastName($body["lastName"]);
            $employee->setJob($body["job"]);
            $employee->setTeam($body["team"]);
            $employee->setAgency($body["agency"]);
            $employee->setProImage($body["proImage"] ?? "");
            $employee->setFunImage($body["funImage"] ?? "");
            $this->employeeRepository->save($employee);
            return new Response("Created employee " . $body["name"] . " " . $body["lastName"], 200);
        }
        return new Response("Employee " . $body["name"] . " " . $body["lastName"] . " already exists.", 400);
    }

    /**
     * @throws \Exception
     */
    #[Route('/infos/employee/{id}', name: 'app_infos_employee_patch', methods: "PATCH")]
    public function patchEmployee(Request $request, $id): Response
    {
        $body = json_decode($request->getContent(), true);

        $existingEmployee = $this->employeeRepository->findOneBy(["id" => intval($id)]);
        try {
            $this->employeeRepository->updateEmployeeById(intval($id), $body);
            return new Response("Modified employee " . $body["name"] . " " . $body["lastName"], 200);
        } catch (\Exception $e) {
            return new Response("Employee " . $existingEmployee->getName() . " " . $existingEmployee->getLastName() . " not found.", 404);
        }
    }

    #[Route('/infos/employee/{id}', name: 'app_infos_employee_patch', methods: "DELETE")]
    public function deleteEmployee(string $id): Response
    {

        $existingEmployee = $this->employeeRepository->findOneBy(["id" => intval($id)]);
        try {
            $this->employeeRepository->deleteEmployeeById(intval($id));
            return new Response("Modified employee " . $existingEmployee->getName() . " " . $existingEmployee->getLastName() , 200);
        } catch (\Exception $e) {
            return new Response("Employee " . $existingEmployee->getName() . " " . $existingEmployee->getLastName() . " not found.", 404);
        }
    }
}
