<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
#[ApiResource]
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity=TimeSlot::class, inversedBy="reservation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $slot;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservationPatient")
     * @ORM\JoinColumn(nullable=true)
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="doctorReservation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $doctor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSlot(): ?TimeSlot
    {
        return $this->slot;
    }

    public function setSlot(TimeSlot $slot): self
    {
        $this->slot = $slot;

        return $this;
    }

    public function getPatient(): ?User
    {
        return $this->patient;
    }

    public function setPatient(?User $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getDoctor(): ?User
    {
        return $this->doctor;
    }

    public function setDoctor(?User $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }
}
