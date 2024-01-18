<?php

namespace App\Repository;

use App\Entity\AdminUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdminUser::class);
    }

    public function save(AdminUser $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }
    public function updateUserById(int $userId, array $dataToUpdate): void
    {
        $user = $this->_em->getRepository(AdminUser::class)->find($userId);

        if (!$user) {
            throw new \Exception("User with ID $userId not found.");
        }

        foreach ($dataToUpdate as $property => $value) {
            $setterMethod = 'set' . ucfirst($property);
            $user->$setterMethod($value);
        }
        $this->_em->flush();
    }

    public function deleteUserById(int $userId): void
    {
        $user = $this->_em->getRepository(AdminUser::class)->find($userId);

        if (!$user) {
            throw new \Exception("User with ID $userId not found.");
        }

        $this->_em->remove($user);
        $this->_em->flush();
    }

    public function getAllUser() : array
    {
        return $this->findAll();
    }

    public function findOneByEmail(string $email): ?AdminUser
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function findOneById(int $id): ?AdminUser
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findOneByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findOneByEmailOrName(string $email): ?AdminUser
    {
        $user = $this->findOneByEmail($email);
        if ($user)
            return $user;

        return $this->findOneByName($email);
    }
}