<?php

namespace app\database\entities;

use core\database\entities\AbstractEntity;
use DateTimeImmutable;

class UserEntity extends AbstractEntity
{
  protected ?int $id;
  protected ?string $firstName;
  protected ?string $lastName;
  protected ?string $email;
  protected ?string $image;
  protected ?string $avatar_id;
  protected ?string $password;
  protected ?DateTimeImmutable $created_at;
  protected ?DateTimeImmutable $updated_at;

  public function getId(): ?int
  {
    return $this->id ?? null;
  }

  public function getFirstName(): ?string
  {
    return $this->firstName ?? null;
  }

  public function getLastName(): ?string
  {
    return $this->lastName ?? null;
  }

  public function getEmail(): ?string
  {
    return $this->email ?? null;
  }

  public function getImage(): ?string
  {
    return $this->image ?? null;
  }

  public function getAvatar_id(): ?string
  {
    return $this->avatar_id ?? null;
  }

  public function getPassword(): ?string
  {
    return $this->password ?? null;
  }

  public function getCreated_at(): ?string
  {
    return $this->created_at ?? null;
  }

  public function getUpdated_at(): ?string
  {
    return $this->updated_at ?? null;
  }

  public function setId(?int $id): self
  {
    $this->id = $id;
    return $this;
  }

  public function setFirstName(?string $firstName): self
  {
    $this->firstName = $firstName;
    return $this;
  }

  public function setLastName(?string $lastName): self
  {
    $this->lastName = $lastName;
    return $this;
  }

  public function setEmail(?string $email): self
  {
    $this->email = $email;
    return $this;
  }

  public function setImage(?string $image): self
  {
    $this->image = $image;
    return $this;
  }

  public function setAvatar_id(?string $avatar_id): self
  {
    $this->avatar_id = $avatar_id;
    return $this;
  }

  public function setPassword(?string $password): self
  {
    $this->password = $password;
    return $this;
  }

  public function setCreated_at(?DateTimeImmutable $created_at): self
  {
    $this->created_at = $created_at;
    return $this;
  }

  public function setUpdated_at(?DateTimeImmutable $updated_at): self
  {
    $this->updated_at = $updated_at;
    return $this;
  }
}
