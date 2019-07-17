<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
  public function create ($host, Request $request)
  {
    $doctrine = $this->getDoctrine();
    $userRepository = $doctrine->getRepository(User::class);
    $entityManager = $doctrine->getManager();

    $host = $userRepository->findBy([
      'isHost' => true,
      'uid' => $host
    ]);

    if (!$host) {
      return new JsonResponse([
        'message' => 'error',
        'response' => [
          'errorCode' => 400,
          'errorMessage' => 'The host specified does not exist',
        ]
      ], 404);
    }

    $guests = $request->request->get('guests', []);
    if (!empty($guests)) {
      foreach ($guests as $guest) {

      }
    } else {
      return new JsonResponse([
        'message' => 'error',
        'response' => [
          'errorCode' => 400,
          'errorMessage' => 'No guests provided',
        ]
      ], 404);
    }

    $reservation = new Reservation();
//    $reservation->setHost()
  }
}
