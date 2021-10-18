<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StreetFoodRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"="street_food_read"},
 *     denormalizationContext={"groups"="street_food_write"},
 *     collectionOperations={
 *          "GET"={
 *              "normalization_context"={"groups"={"street_food_read_cget"}},
 *          },
 *          "POST"={
 *              "normalization_context"={"groups"={"street_food_read_post"}},
 *              "denormalization_context"={"groups"={"street_food_write_post"}},
 *          }
 *     },
 *     itemOperations={
 *          "GET"={
 *              "normalization_context"={"groups"={"street_food_read_get"}},
 *          },
 *     }
 * )
 * @ORM\Entity(repositoryClass=StreetFoodRepository::class)
 */
class StreetFood
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"street_food_read", "street_food_write", "category_read", "street_food_write_post"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"street_food_read", "street_food_write", "street_food_write_post"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"street_food_read", "street_food_write", "street_food_write_post"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"street_food_read", "street_food_write", "street_food_write_post"})
     */
    private $cp;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="streetFood", cascade="persist")
     * @Groups({"street_food_read", "street_food_write"})
     */
    private $category;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
