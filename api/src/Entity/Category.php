<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"="category_read"}
 * )
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"category_read", "street_food_get", "street_food_write_post"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=StreetFood::class, mappedBy="category", cascade="persist")
     * @Groups("category_read")
     */
    private $streetFood;

    public function __construct()
    {
        $this->streetFood = new ArrayCollection();
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

    /**
     * @return Collection|StreetFood[]
     */
    public function getStreetFood(): Collection
    {
        return $this->streetFood;
    }

    public function addStreetFood(StreetFood $streetFood): self
    {
        if (!$this->streetFood->contains($streetFood)) {
            $this->streetFood[] = $streetFood;
            $streetFood->setCategory($this);
        }

        return $this;
    }

    public function removeStreetFood(StreetFood $streetFood): self
    {
        if ($this->streetFood->contains($streetFood)) {
            $this->streetFood->removeElement($streetFood);
            // set the owning side to null (unless already changed)
            if ($streetFood->getCategory() === $this) {
                $streetFood->setCategory(null);
            }
        }

        return $this;
    }
}
