<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\MeController;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"user_read"}}
 *          },
 *          "post",
 *          "me"={
 *               "pagination_enabled"="false","path"="/me","method"="get","controller"=MeController::class,"read":"false"
 *          },
 *          "create_user"={
 *              "method"="POST",
 *              "path"="/users/create",
 *              "controller"=App\Controller\CreateUser::class
 *          }
 *      },
 *     itemOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"user_details_read"}}
 *          },
 *          "put",
 *          "patch",
 *          "delete"
 *     }
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user_read", "user_details_read"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"user_read", "user_details_read"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     *
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read", "user_details_read"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read", "user_details_read"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read", "user_details_read"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read", "user_details_read"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read", "user_details_read"})
     */
    private $birthday;

    /**
     * @ORM\OneToMany(targetEntity=TimeSlot::class, mappedBy="doctor")
     */
    private $timeSlots;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="patient")
     */
    private $reservationPatient;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="doctor")
     */
    private $doctorReservation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_read", "user_details_read"})
     */
    private $metier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_read", "user_details_read"})
     */
    private $descriptionDoctor;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"user_read", "user_details_read"})
     */
    public ?Image $image = null;

    public function __construct()
    {
        $this->timeSlots = new ArrayCollection();
        $this->reservationPatient = new ArrayCollection();
        $this->doctorReservation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return Collection|TimeSlot[]
     */
    public function getTimeSlots(): Collection
    {
        return $this->timeSlots;
    }

    public function addTimeSlot(TimeSlot $timeSlot): self
    {
        if (!$this->timeSlots->contains($timeSlot)) {
            $this->timeSlots[] = $timeSlot;
            $timeSlot->setDoctor($this);
        }

        return $this;
    }

    public function removeTimeSlot(TimeSlot $timeSlot): self
    {
        if ($this->timeSlots->removeElement($timeSlot)) {
            // set the owning side to null (unless already changed)
            if ($timeSlot->getDoctor() === $this) {
                $timeSlot->setDoctor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservationPatient(): Collection
    {
        return $this->reservationPatient;
    }

    public function addReservationPatient(Reservation $reservationPatient): self
    {
        if (!$this->reservationPatient->contains($reservationPatient)) {
            $this->reservationPatient[] = $reservationPatient;
            $reservationPatient->setPatient($this);
        }

        return $this;
    }

    public function removeReservationPatient(Reservation $reservationPatient): self
    {
        if ($this->reservationPatient->removeElement($reservationPatient)) {
            // set the owning side to null (unless already changed)
            if ($reservationPatient->getPatient() === $this) {
                $reservationPatient->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getDoctorReservation(): Collection
    {
        return $this->doctorReservation;
    }

    public function addDoctorReservation(Reservation $doctorReservation): self
    {
        if (!$this->doctorReservation->contains($doctorReservation)) {
            $this->doctorReservation[] = $doctorReservation;
            $doctorReservation->setDoctor($this);
        }

        return $this;
    }

    public function removeDoctorReservation(Reservation $doctorReservation): self
    {
        if ($this->doctorReservation->removeElement($doctorReservation)) {
            // set the owning side to null (unless already changed)
            if ($doctorReservation->getDoctor() === $this) {
                $doctorReservation->setDoctor(null);
            }
        }

        return $this;
    }

    public function getMetier(): ?string
    {
        return $this->metier;
    }

    public function setMetier(?string $metier): self
    {
        $this->metier = $metier;

        return $this;
    }

    public function getDescriptionDoctor(): ?string
    {
        return $this->descriptionDoctor;
    }

    public function setDescriptionDoctor(?string $descriptionDoctor): self
    {
        $this->descriptionDoctor = $descriptionDoctor;

        return $this;
    }
}
