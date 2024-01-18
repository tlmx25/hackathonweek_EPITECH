<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class DbController extends AbstractController {
    private $employeeRepository;
    private mixed $dataContent;

    public function __construct(
        EmployeeRepository $employeeRepository
    )
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
        $this->dataContent = json_decode($data, true);
        $this->employeeRepository = $employeeRepository;
    }

    #[Route('/init', name: 'app_infos', methods: "POST")]
    public function index(): Response
    {
        foreach ($this->dataContent as $elem) {
            $employee = new Employee();
            $employee->setName($elem["prenom"]);
            $employee->setLastName($elem["nom"]);
            $employee->setJob($elem["poste"]);
            $employee->setTeam($elem["equipe"]);
            $employee->setAgency($elem["agence"]);
            $employee->setProImage($elem["photo_pro"] ?? "");
            $employee->setFunImage($elem["photo_fun"] ?? "");
            $this->employeeRepository->save($employee);
        }
        return new JsonResponse("Created employees");
    }
}