<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserReservationFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    $userRepository = $manager->getRepository(User::class);
    $hosts = $userRepository->findBy(
      ['isHost' => 1]
    );
    $all = $userRepository->findAll();

    foreach ($hosts as $x => $host) {
      $max = random_int(0, 4);
      for ($i = 0; $i <= $max; $i++) {
        $guest = $this->randomGuest($all, $x);
        $reservation = new Reservation();
        $reservation->setHost($host);
        $reservation->setGuest($guest);
        $manager->persist($reservation);
      }
    }
    $manager->flush();
  }

  /**
   * @param $hosts
   * @param $exclude
   * @return mixed
   */
  private function randomGuest ($hosts, $exclude)
  {
    $guest = array_rand($hosts);
    return ($exclude === $guest) ? $this->randomGuest($hosts, $exclude) : $hosts[$guest];
  }
}
