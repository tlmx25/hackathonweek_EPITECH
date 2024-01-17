<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(length: 255)]
    private ?string $name = null;
    #[ORM\Column(length: 255)]
    private ?string $job = null;
    #[ORM\Column(length: 255)]
    private ?string $team = null;
    #[ORM\Column(length: 255)]
    private ?string $agency = null;
    #[ORM\Column(length: 255)]
    private ?string $proImage = null;
    #[ORM\Column(length: 255)]
    private ?string $funImage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): void
    {
        $this->job = $job;
    }

    public function getTeam(): ?string
    {
        return $this->team;
    }

    public function setTeam(?string $team): void
    {
        $this->team = $team;
    }

    public function getAgency(): ?string
    {
        return $this->agency;
    }

    public function setAgency(?string $agency): void
    {
        $this->agency = $agency;
    }

    public function getProImage(): ?string
    {
        return $this->proImage;
    }

    public function setProImage(?string $proImage): void
    {
        $this->proImage = $proImage;
    }

    public function getFunImage(): ?string
    {
        return $this->funImage;
    }

    public function setFunImage(?string $funImage): void
    {
        $this->funImage = $funImage;
    }
}
