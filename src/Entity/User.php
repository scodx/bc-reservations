<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
  /**
   * @var int
   *
   * @ORM\Column(name="uid", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="IDENTITY")
   */
  private $uid;

  /**
   * @var string|null
   *
   * @ORM\Column(name="name", type="string", length=255, nullable=true)
   */
  private $name;

  /**
   * @var string
   *
   * @ORM\Column(name="first_name", type="string", precision=100, scale=0, nullable=false)
   */
  private $firstName;

  /**
   * @var string
   *
   * @ORM\Column(name="last_name", type="string", length=100, nullable=false)
   */
  private $lastName;

  /**
   * @var string|null
   *
   * @ORM\Column(name="email", type="string", length=45, nullable=false)
   */
  private $email;

  /**
   * @var int
   *
   * @ORM\Column(name="is_host", type="boolean", nullable=false)
   */
  private $isHost = '0';

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="date_of_birth", type="date", nullable=true)
   */
  private $dateOfBirth;

  /**
   * @var string|null
   *
   * @ORM\Column(name="lat", type="decimal", precision=10, scale=8, nullable=true)
   */
  private $lat;

  /**
   * @var string|null
   *
   * @ORM\Column(name="lng", type="decimal", precision=11, scale=8, nullable=true)
   */
  private $lng;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="updated_at", type="datetime", nullable=false)
   */
  private $updatedAt;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="created_at", type="datetime", nullable=false)
   */
  private $createdAt;

  public function getUid(): ?int
  {
    return $this->uid;
  }

  public function getName(): ?string
  {
    $name = $this->name;
    if (!strlen($name)) {
      $name = $this->getFirstName() .' '. $this->getLastName();
    }
    return $name;
  }

  public function setName(?string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getFirstName()
  {
    return $this->firstName;
  }

  public function setFirstName($firstName): self
  {
    $this->firstName = $firstName;

    return $this;
  }

  public function getLastName(): ?string
  {
    return $this->lastName;
  }

  public function setLastName(string $lastName): self
  {
    $this->lastName = $lastName;

    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(?string $email): self
  {
    $this->email = $email;

    return $this;
  }

  public function getIsHost(): ?bool
  {
    return $this->isHost;
  }

  public function setIsHost(bool $isHost): self
  {
    $this->isHost = $isHost;

    return $this;
  }

  public function getDateOfBirth(): ?\DateTimeInterface
  {
    return $this->dateOfBirth;
  }

  public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): self
  {
    $this->dateOfBirth = $dateOfBirth;

    return $this;
  }

  public function getLat()
  {
    return $this->lat;
  }

  public function setLat($lat): self
  {
    $this->lat = $lat;

    return $this;
  }

  public function getLng()
  {
    return $this->lng;
  }

  public function setLng($lng): self
  {
    $this->lng = $lng;

    return $this;
  }

  public function getUpdatedAt(): ?\DateTimeInterface
  {
    return $this->updatedAt;
  }

  public function setUpdatedAt(\DateTimeInterface $updatedAt): self
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  public function getCreatedAt(): ?\DateTimeInterface
  {
    return $this->createdAt;
  }

  public function setCreatedAt(\DateTimeInterface $createdAt): self
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * converts user data to array in order to return it in the api
   *
   * @return array
   */
  public function toAPIArray ()
  {
    return [
      'uid' => $this->getUid(),
      'name' => $this->getName(),
      'first_name' => $this->getFirstName(),
      'last_name' => $this->getLastName(),
      'email' => $this->getEmail(),
      'is_host' => $this->getIsHost(),
      'lat' => $this->getLat(),
      'lng' => $this->getLng(),
      'date_of_birth' => $this->getDateOfBirth(),
      'created_at' => $this->getCreatedAt(),
      'updated_at' => $this->getUpdatedAt(),
    ];

  }

}
