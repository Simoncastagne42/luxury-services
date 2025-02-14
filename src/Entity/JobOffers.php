<?php

namespace App\Entity;

use App\Repository\JobOffersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobOffersRepository::class)]
class JobOffers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $recruiterId = null;

    #[ORM\Column(length: 255)]
    private ?string $jobTittle = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $salary = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'jobOffers')]
    private ?Category $jobCategory = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateCreated = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecruiterId(): ?int
    {
        return $this->recruiterId;
    }

    public function setRecruiterId(int $recruiterId): static
    {
        $this->recruiterId = $recruiterId;

        return $this;
    }

    public function getJobTittle(): ?string
    {
        return $this->jobTittle;
    }

    public function setJobTittle(string $jobTittle): static
    {
        $this->jobTittle = $jobTittle;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(string $salary): static
    {
        $this->salary = $salary;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getJobCategory(): ?Category
    {
        return $this->jobCategory;
    }

    public function setJobCategory(?Category $jobCategory): static
    {
        $this->jobCategory = $jobCategory;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeImmutable
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeImmutable $dateCreated): static
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

   
}
