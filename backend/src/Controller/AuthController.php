<?php

namespace App\Controller;

use App\Entity\AdminUser;
use App\Repository\UserRepository;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    #[NoReturn]
    private function checkAdmin() : void
    {
        $adminUser = $this->userRepository->findOneByEmailOrName('admin');
        if (!$adminUser) {
            $adminUser = new AdminUser();
            $adminUser->setName('admin');
            $adminUser->setEmail('admin');
            $adminUser->setPassword(password_hash('admin', PASSWORD_BCRYPT));
            $this->userRepository->save($adminUser);
        }
    }

    private function checkToken($request) : bool
    {
        $token = $request->headers->get('authorization');
        if (!$token) {
            return false;
        }
        $token = str_replace('Bearer ', '', $token);
        try {
            $key = getenv('JWT_SECRET');
            JWT::decode($token, new Key($key, 'HS256') );
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    #[Route('/auth', name: 'app_auth', methods: "POST")]
    public function login(Request $request) : Response
    {
        $data = json_decode($request->getContent(), true);

        $this->checkAdmin();

        if (!isset($data['username']) || !isset($data['password'])) {
            return new JsonResponse(['message' => 'Identifiant et mot de passe requis.'], 400);
        }

        $user = $this->userRepository->findOneByEmailOrName($data['username']);
        if (!$user) {
            return new JsonResponse(['message' => 'Identifiant ou mot de passe incorrect.'], 400);
        }
        $isGoodPassword = password_verify($data['password'] , $user->getPassword());
        if (!$isGoodPassword) {
            return new JsonResponse(['message' => 'Identifiant ou mot de passe incorrect.'], 400);
        }

        $payload = [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail()
        ];
        $token = JWT::encode($payload, getenv('JWT_SECRET'), 'HS256', null, ['expires_in' => '10h']);

        return new JsonResponse(['token' => $token], 200);
    }

    #[Route('/auth/addUser', name: 'app_auth', methods: "POST")]
    public function addUser(Request $request) : Response
    {
        if (!$this->checkToken($request)) {
            return new JsonResponse(['message' => "Invalide token"], 401);
        }
        $data = json_decode($request->getContent(), true);


        if (!isset($data['username']) || !isset($data['password']) || !isset($data['email'])) {
            return new JsonResponse(['message' => 'Identifiant, email et mot de passe requis.'], 400);
        }

        $user = $this->userRepository->findOneByEmailOrName($data['username']);
        $user2 = $this->userRepository->findOneByEmailOrName($data['email']);
        if ($user || $user2) {
            return new JsonResponse(['message' => 'Identifiant ou email déjà utilisé.'], 400);
        }

        $user = new AdminUser();
        $user->setName($data['username']);
        $user->setEmail($data['email']);
        $user->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
        $this->userRepository->save($user);

        return new JsonResponse(['message' => 'Utilisateur ajoute.'], 201);
    }

    #[Route('/auth/deleteUser', name: 'app_auth', methods: "DELETE")]
    public function deleteUser(Request $request) : Response
    {
        if (!$this->checkToken($request)) {
            return new JsonResponse(['message' => "Invalide token"], 401);
        }
        $data = json_decode($request->getContent(), true);

        if (!isset($data['username'])) {
            return new JsonResponse(['message' => 'Identifiant requis.'], 400);
        }

        $user = $this->userRepository->findOneByEmailOrName($data['username']);
        if (!$user) {
            return new JsonResponse(['message' => 'Identifiant incorrect.'], 400);
        }

        $this->userRepository->deleteUserById($user->getId());
        return new JsonResponse(['message' => 'Utilisateur supprime.'], 200);
    }

    #[Route('/auth/users', name: 'app_auth', methods: "GET")]
    public function getAllUser(Request $request) : Response
    {
        if (!$this->checkToken($request)) {
            return new JsonResponse(['message' => "Invalide token"], 401);
        }


        $users = $this->userRepository->getAllUser();
        $users = array_map(function ($user) {
            return [
                'name' => $user->getName(),
                'email' => $user->getEmail()
            ];
        }, $users);
        return new JsonResponse(["users" => $users], 200);
    }

    #[Route('/auth/check', name: 'app_auth', methods: "GET")]
    public function verifyToken(Request $request) : Response
    {
        if ($this->checkToken($request)) {
            return new JsonResponse(["message" => "valid token"], 200);
        }

        return new JsonResponse(["message" => "token is not valid"], 401);
    }
}