<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class UserFixture extends Fixture
{

  private $faker;

  public function __construct ()
  {
    $this->faker = Factory::create();
  }

  public function load(ObjectManager $manager)
  {
    $max = random_int(60, 80);
    for ($i = 0; $i <= $max; $i++) {
      $user = new User();
      $user->setEmail($this->faker->email);
      $user->setFirstName($this->faker->firstName);
      $user->setLastName($this->faker->lastName);
      $user->setIsHost($this->faker->numberBetween(0,1));
      $user->setDateOfBirth($this->faker->dateTimeBetween('-50 years', '-30 years'));
      if ($this->faker->numberBetween(0,1)) {
        $user->setLat($this->faker->latitude);
        $user->setLng($this->faker->longitude);
      }
      $user->setCreatedAt($this->faker->dateTimeBetween('-10 days', '-6 days'));
      $user->setUpdatedAt($this->faker->dateTimeBetween('-5 days'));
      $manager->persist($user);
    }
    $manager->flush();
  }
}
