<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use App\Tools\Str;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\Table(name="articles")
 */
class Article
{

    const ANIME = 'anime', MANGA = 'manga', RANOBE = 'ranobe';

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
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="string", columnDefinition="enum('G', 'PG', 'PG-13', 'PG-17+', 'R-17', 'R+', 'Rx')")
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

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class)
     */
    private $genres;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $scores;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $episodes;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $episode_duration;

    /**
     * @ORM\Column(type="string", columnDefinition="enum('released', 'anons', 'ongoing', 'latest')", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $license;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $premiere_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poster_url;

    /**
     * @ORM\OneToOne(targetEntity=ArticleSourcePage::class, inversedBy="article", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="source_page", referencedColumnName="id", onDelete="SET NULL")
     */
    private $source_page;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
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

    public function getUriAlias(): ?string
    {
        return $this->uri_alias;
    }

    public function setUriAlias(string $uri_alias): self
    {
        $this->uri_alias = $uri_alias;
        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function getScores(): ?float
    {
        return $this->scores;
    }

    public function setScores(?float $scores): self
    {
        $this->scores = $scores;

        return $this;
    }

    public function getEpisodes(): ?int
    {
        return $this->episodes;
    }

    public function setEpisodes(?int $episodes): self
    {
        $this->episodes = $episodes;

        return $this;
    }

    public function getEpisodeDuration(): ?string
    {
        return $this->episode_duration;
    }

    public function setEpisodeDuration(?string $episode_duration): self
    {
        $this->episode_duration = $episode_duration;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(?string $license): self
    {
        $this->license = $license;

        return $this;
    }

    public function getPremiereDate(): ?\DateTimeInterface
    {
        return $this->premiere_date;
    }

    public function setPremiereDate(?\DateTimeInterface $premiere_date): self
    {
        $this->premiere_date = $premiere_date;

        return $this;
    }

    public function getPosterUrl(): string
    {
        return $this->poster_url;
    }

    public function setPosterUrl(?string $poster_url): self
    {
        $this->poster_url = $poster_url;

        return $this;
    }

    public function getSourcePage(): ?ArticleSourcePage
    {
        return $this->source_page;
    }

    public function setSourcePage(?ArticleSourcePage $source_page): self
    {
        $this->source_page = $source_page;

        return $this;
    }

    public function generateUriAlias():string
    {
        $parts = [rand(100, 999), $this->getName()];
        if ($this->getYear()) {
            $parts = [$this->getYear()];
        }
        $str = implode(' ', $parts);
        return Str::slugify($str);
    }

}
