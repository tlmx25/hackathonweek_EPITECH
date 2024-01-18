<?php

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EmployeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    public function save(Employee $employee): void
    {
        $this->_em->persist($employee);
        $this->_em->flush();
    }

    public function updateEmployeeById(int $employeeId, array $dataToUpdate): void
    {
        $employee = $this->_em->getRepository(Employee::class)->find($employeeId);

        if (!$employee) {
            throw new \Exception("Employee with ID $employeeId not found.");
        }

        foreach ($dataToUpdate as $property => $value) {
            // Exclude updating the ID
            if ($property !== 'id') {
                $setterMethod = 'set' . ucfirst($property);
                $employee->$setterMethod($value);
            }
        }

        $this->_em->flush();
    }


    public function deleteEmployeeById(int $employeeId): void
    {
        $employee = $this->_em->getRepository(Employee::class)->find($employeeId);

        if (!$employee) {
            throw new \Exception("Employee with ID $employeeId not found.");
        }

        $this->_em->remove($employee);
        $this->_em->flush();
    }
}
