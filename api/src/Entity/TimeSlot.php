<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TimeSlotRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


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
     * @Groups("user:read")
     */
    private $doctor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $available;


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

}
