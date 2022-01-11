<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TimeSlotRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TimeSlotRepository::class)
 */
#[ApiResource]
class TimeSlot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $slotStart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $slotEnd;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="timeSlots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $available;

    /**
     * @ORM\OneToOne(targetEntity=Reservation::class, mappedBy="slot", cascade={"persist", "remove"})
     */
    private $reservation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlotStart(): ?\DateTime
    {
        return $this->slotStart;
    }

    public function setSlotStart(\Datetime $slotStart): self
    {
        $this->slotStart = $slotStart;

        return $this;
    }

        public function getslotEnd(): ?\DateTime
    {
        return $this->slotEnd;
    }

    public function setSlotEnd(\Datetime $slotEnd): self
    {
        $this->slotEnd = $slotEnd;

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

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): self
    {
        // set the owning side of the relation if necessary
        if ($reservation->getSlot() !== $this) {
            $reservation->setSlot($this);
        }

        $this->reservation = $reservation;

        return $this;
    }
}
