<?php

namespace App\Entity;

use App\Repository\TitleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TitleRepository::class)
 * @ORM\Table(name="titles")
 */
class Title
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="smallint")
     */
    private $year;

    /**
     * @ORM\Column(type="string", columnDefinition="enum('G', 'PG', 'PG-13', 'PG-17+', 'R+')")
     */
    private $age_rating;

    /**
     * @ORM\Column(type="string", columnDefinition="enum('anime', 'manga', 'ranobe')")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uri_alias;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getAgeRating(): ?string
    {
        return $this->age_rating;
    }

    public function setAgeRating(string $age_rating): self
    {
        $this->age_rating = $age_rating;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPageUri(): ?string
    {
        return '/' . $this->getType() . '/' . $this->getUriAlias();
    }

    public function getPosterUrl(): string
    {
        return '/img/covers/placeholder.jpg';
    }

    public function getUriAlias(): ?string
    {
        return $this->uri_alias;
    }

    public function setUriAlias(string $uri_alias): self
    {
        $this->uri_alias = $uri_alias;
        return $this;
    }
}