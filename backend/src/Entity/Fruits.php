<?php

namespace App\Entity;

use App\Repository\FruitsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FruitsRepository::class)
 */
class Fruits
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $family;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orders;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $carbohydrates;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $protein;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $calories;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sugar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $favorite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenus(): ?string
    {
        return $this->genus;
    }

    public function setGenus(?string $genus): self
    {
        $this->genus = $genus;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(?string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getOrders(): ?string
    {
        return $this->orders;
    }

    public function setOrders(?string $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    public function getCarbohydrates(): ?string
    {
        return $this->carbohydrates;
    }

    public function setCarbohydrates(?string $carbohydrates): self
    {
        $this->carbohydrates = $carbohydrates;

        return $this;
    }

    public function getProtein(): ?string
    {
        return $this->protein;
    }

    public function setProtein(?string $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getFat(): ?string
    {
        return $this->fat;
    }

    public function setFat(?string $fat): self
    {
        $this->fat = $fat;

        return $this;
    }

    public function getCalories(): ?string
    {
        return $this->calories;
    }

    public function setCalories(?string $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    public function getSugar(): ?string
    {
        return $this->sugar;
    }

    public function setSugar(?string $sugar): self
    {
        $this->sugar = $sugar;

        return $this;
    }

    public function getFavorite(): ?string
    {
        return $this->favorite;
    }

    public function setFavorite(?string $favorite): self
    {
        $this->favorite = $favorite;

        return $this;
    }
}
