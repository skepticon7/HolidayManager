<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/user')]
final class UserController extends AbstractController
{
    #[Route('/registerUser', name: 'app_user', methods: ['POST'])]
    public function registerUser(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): JsonResponse

    {
        try {
            $data = json_decode($request->getContent(), true); // Use getContent() for HTTP request bodies

            if (!$data) {
                return new JsonResponse(['errors' => 'Form is invalid'], Response::HTTP_BAD_REQUEST);
            }

            // Validate required fields
            if (!isset($data['username'], $data['email'], $data['country'], $data['city'], $data['birthday'], $data['password'])) {
                return new JsonResponse(['errors' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
            }

            // Create a new User entity and set its properties
            $user = new User();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setCountry($data['country']);
            $user->setCity($data['city']);
            $user->setBirthday(new \DateTime($data['birthday']));
            $user->setPassword($userPasswordHasher->hashPassword($user, $data['password']));
            $user->setProfilePicture($data['profile_picture']);

            // Persist and save the entity
            $entityManager->persist($user);
            $entityManager->flush();

            return new JsonResponse([
                'user' => [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'email' => $user->getEmail(),
                    'country' => $user->getCountry(),
                    'city' => $user->getCity(),
                    'birthday' => $user->getBirthday(),
                    'profile_picture' => $user->getProfilePicture(),
                    'password'=> $user->getPassword()
                ]
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/getUsers', name: 'app_login', methods: ['GET'])]
    public function getUsers(EntityManagerInterface $entityManager , SerializerInterface $serializer): JsonResponse {
        try {
            $data = $entityManager->getRepository(User::class)->findAll();
            $json = $serializer->serialize($data, 'json', ['groups' => 'groups_list']);
            return new JsonResponse($json, Response::HTTP_OK, [], true);
        } catch(\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
