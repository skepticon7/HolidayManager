<?php

namespace App\Entity;

use App\Repository\HolidayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HolidayRepository::class)]
class Holiday
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'holidays')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $holiday_image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    /**
     * @var Collection<int, HolidayImage>
     */
    #[ORM\OneToMany(targetEntity: HolidayImage::class, mappedBy: 'holiday_id')]
    private Collection $Holiday;

    public function __construct()
    {
        $this->Holiday = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getHolidayImage(): ?string
    {
        return $this->holiday_image;
    }

    public function setHolidayImage(string $holiday_image): static
    {
        $this->holiday_image = $holiday_image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, HolidayImage>
     */
    public function getHoliday(): Collection
    {
        return $this->Holiday;
    }

    public function addHoliday(HolidayImage $holiday): static
    {
        if (!$this->Holiday->contains($holiday)) {
            $this->Holiday->add($holiday);
            $holiday->setHolidayId($this);
        }

        return $this;
    }

    public function removeHoliday(HolidayImage $holiday): static
    {
        if ($this->Holiday->removeElement($holiday)) {
            // set the owning side to null (unless already changed)
            if ($holiday->getHolidayId() === $this) {
                $holiday->setHolidayId(null);
            }
        }

        return $this;
    }
}
