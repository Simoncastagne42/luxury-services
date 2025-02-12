<?php

namespace App\Entity;

use App\Repository\CandidateRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Annotation\IgnoreCompletion;
use Doctrine\Common\Annotations\AnnotationReader;

#[ORM\Entity(repositoryClass: CandidateRepository::class)]
class Candidate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[IgnoreCompletion]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    #[IgnoreCompletion]
    private ?string $profilePicture = null;

    #[ORM\OneToOne(inversedBy: 'candidate', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[IgnoreCompletion]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'candidates')]
    private ?Gender $gender = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[IgnoreCompletion]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[IgnoreCompletion]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    #[IgnoreCompletion]
    private ?\DateTimeImmutable $deletedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationality = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $birthDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $birthPlace = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $passport = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $currentLocation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'candidates')]
    private ?Category $jobCategory = null;

    #[ORM\ManyToOne(inversedBy: 'candidates')]
    private ?Experience $experience = null;


    public function __construct(DateTimeImmutable $createdAt = new DateTimeImmutable(), DateTimeImmutable $updatedAt = new DateTimeImmutable())
    {
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): static
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeImmutable $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    public function setBirthPlace(?string $birthPlace): static
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    public function getPassport(): ?string
    {
        return $this->passport;
    }

    public function setPassport(?string $passport): static
    {
        $this->passport = $passport;

        return $this;
    }

    public function getCurrentLocation(): ?string
    {
        return $this->currentLocation;
    }

    public function setCurrentLocation(?string $currentLocation): static
    {
        $this->currentLocation = $currentLocation;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
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

    public function getExperience(): ?Experience
    {
        return $this->experience;
    }

    public function setExperience(?Experience $experience): static
    {
        $this->experience = $experience;

        return $this;
    }

    public function getProfileCompletion(): int
    {
        $ignoredFields = $this->getIgnoredFields();

        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);

        $totalFields = 0;
        $filledFields = 0;

        foreach ($properties as $property) {
            $name = $property->getName();

            if (!in_array($name, $ignoredFields)) {
                $totalFields++;
                $value = $property->getValue($this);
                if (!empty($value)) {
                    $filledFields++;
                }
            }
        }

        return $totalFields > 0 ? intval(($filledFields / $totalFields) * 100) : 0;
    }

    private function getIgnoredFields(): array
    {
        $ignoredFields = [];
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $reader = new AnnotationReader();
            $annotations = $reader->getPropertyAnnotations($property);
            foreach ($annotations as $annotation) {
                if ($annotation instanceof IgnoreCompletion) {
                    $ignoredFields[] = $property->getName();
                }
            }
        }

        return $ignoredFields;
    }
}
