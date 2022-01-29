<?php

namespace App\Entity;

use App\Repository\TitleSourcePageRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity(repositoryClass=TitleSourcePageRepository::class)
 * @ORM\Table(name="titles_source_pages",
 *    uniqueConstraints={
 *        @UniqueConstraint(name="url",
 *            columns={"url"})
 *    }
 * )
 */
class TitleSourcePage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", columnDefinition="enum('shikimori', 'yamianime', 'anivisual')")
     */
    private $source_alias;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", columnDefinition="enum('anime', 'manga', 'ranobe')")
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_time;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_scan_time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getSourceAlias(): ?string
    {
        return $this->source_alias;
    }

    public function setSourceAlias(string $source_alias): self
    {
        $this->source_alias = $source_alias;

        return $this;
    }

    public function getCreateTime(): ?\DateTimeInterface
    {
        return $this->create_time;
    }

    public function setCreateTime(?\DateTimeInterface $create_time): self
    {
        $this->create_time = $create_time;

        return $this;
    }

    public function getLastScanTime(): ?\DateTimeInterface
    {
        return $this->last_scan_time;
    }

    public function setLastScanTime(?\DateTimeInterface $last_scan_time): self
    {
        $this->last_scan_time = $last_scan_time;

        return $this;
    }
}
