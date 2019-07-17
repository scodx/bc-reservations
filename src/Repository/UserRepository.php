<?php

namespace App\Repository;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;

class UserRepository extends ServiceEntityRepository
{
  public function __construct(RegistryInterface $registry)
  {
    parent::__construct($registry, User::class);
  }

  public function update (ObjectManager $entityManager, User $user, Request $request)
  {
    $now = new DateTime();
    $user->setName($request->request->get('name', $user->getName()));
    $user->setFirstName($request->request->get('first_name', $user->getFirstName()));
    $user->setLastName($request->request->get('last_name', $user->getLastName()));
    $user->setEmail($request->request->get('email', $user->getEmail()));
    $user->setIsHost($request->request->get('is_host', $user->getIsHost()));
    $user->setLat($request->request->get('lat', $user->getLat()));
    $user->setLng($request->request->get('lng', $user->getLng()));

    if ($request->request->get('date_of_birth')) {
      $user->setDateOfBirth(new DateTime($request->request->get('date_of_birth')));
    }
    $user->setUpdatedAt($now);
    $entityManager->flush($user);
  }
}