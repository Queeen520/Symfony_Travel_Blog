<?php

namespace App\Entity;

use App\Repository\EntriesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntriesRepository::class)]
class Entries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Headline = null;

    #[ORM\Column(length: 255)]
    private ?string $Blogger_Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Destination = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Visit_Date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Entry_Date = null;


    #[ORM\Column(length: 255)]
    private ?string $Story = null;

    #[ORM\ManyToOne]
    private ?Recommend $fk_recommend = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeadline(): ?string
    {
        return $this->Headline;
    }

    public function setHeadline(string $Headline): self
    {
        $this->Headline = $Headline;

        return $this;
    }

    public function getBloggerName(): ?string
    {
        return $this->Blogger_Name;
    }

    public function setBloggerName(string $Blogger_Name): self
    {
        $this->Blogger_Name = $Blogger_Name;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->Destination;
    }

    public function setDestination(string $Destination): self
    {
        $this->Destination = $Destination;

        return $this;
    }

    public function getVisitDate(): ?\DateTimeInterface
    {
        return $this->Visit_Date;
    }

    public function setVisitDate(\DateTimeInterface $Visit_Date): self
    {
        $this->Visit_Date = $Visit_Date;

        return $this;
    }

    public function getEntryDate(): ?\DateTimeInterface
    {
        return $this->Entry_Date;
    }

    public function setEntryDate(\DateTimeInterface $Entry_Date): self
    {
        $this->Entry_Date = $Entry_Date;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->Story;
    }

    public function setStory(string $Story): self
    {
        $this->Story = $Story;

        return $this;
    }

    public function getFkRecommend(): ?Recommend
    {
        return $this->fk_recommend;
    }

    public function setFkRecommend(?Recommend $fk_recommend): self
    {
        $this->fk_recommend = $fk_recommend;

        return $this;
    }
}
