<?php

namespace App\Service;

use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class UserService
{
  public function update (EntityManager $entityManager, User $user, Request $request)
  {
    $now = new DateTime();
    $user->setName($request->request->get('name', $user->getName()));
    $user->setFirstName($request->request->get('first_name', $user->getFirstName()));
    $user->setLastName($request->request->get('last_name', $user->getLastName()));
    $user->setEmail($request->request->get('email', $user->getEmail()));
    $user->setIsHost($request->request->get('is_host', $user->getEmail()));
    $user->setLat($request->request->get('lat', $user->getLat()));
    $user->setLng($request->request->get('lng', $user->getLng()));

    if ($request->request->get('date_of_birth')) {
      $user->setDateOfBirth(new DateTime($request->request->get('date_of_birth')));
    }
    $user->setUpdatedAt($now);
    $entityManager->flush($user);
  }

}