<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserService;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{

  public function get ($uid)
  {
    $user = $this->getDoctrine()
      ->getRepository(User::class)
      ->find($uid);

    if (!$user) {
      return new JsonResponse([
        'message' => 'error',
        'response' => [
          'errorCode' => 400,
          'errorMessage' => 'Record not found',
        ]
      ], 404);
    }

    return new JsonResponse([
      'message' => 'success',
      'response' => $user->toAPIArray()
    ], 200);

  }

  public function update ($uid, Request $request)
  {
    $userRepository = $this->getDoctrine()
      ->getRepository(UserRepository::class);
     $user = $userRepository
      ->find($uid);

    if (!$user) {
      return new JsonResponse([
        'message' => 'error',
        'response' => [
          'errorCode' => 400,
          'errorMessage' => 'Record not found',
        ]
      ], 404);
    }

    $userRepository->update($this->getDoctrine()->getManager(), $user, $request);

    return new JsonResponse([
      'message' => 'success',
      'response' => $user->toAPIArray()
    ], 200);

  }

  /**
   * @param ValidatorInterface $validator
   * @param Request            $request
   * @return JsonResponse
   * @throws Exception
   */
  public function create(ValidatorInterface $validator, Request $request): JsonResponse
  {
    try {
      $entityManager = $this->getDoctrine()->getManager();
      $now = new DateTime();
      $user = new User();
      $user->setName($request->request->get('name'));
      $user->setFirstName($request->request->get('first_name'));
      $user->setLastName($request->request->get('last_name'));
      $user->setEmail($request->request->get('email'));
      $user->setIsHost($request->request->get('is_host'));
      $user->setLat($request->request->get('lat'));
      $user->setLng($request->request->get('lng'));
      $user->setDateOfBirth($request->request->get('date_of_birth') ? new DateTime($request->request->get('date_of_birth'))  : null);
      $user->setCreatedAt($now);
      $user->setUpdatedAt($now);
      $entityManager->persist($user);

      $errors = $validator->validate($user);
      if (count($errors) > 0) {
        throw new \JsonException($errors, 400);
      }

      $entityManager->flush();

    } catch (Exception $exception) {
      return new JsonResponse([
        'message' => 'Bad Request',
        'response' => [
          'errorCode' => 400,
          'errorMessage' => $exception->getMessage(),
        ]
      ], 400);
    }

    return new JsonResponse([
      'message' => 'success',
      'response' => [
        'uid' => $user->getUid()
      ]
    ]);

  }

}
