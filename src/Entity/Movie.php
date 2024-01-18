<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'movie', targetEntity: Review::class, orphanRemoval: true)]
    private Collection $reviews;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $release_year = null;

    #[ORM\ManyToMany(targetEntity: Director::class, inversedBy: 'movies')]
    private Collection $director;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'movies')]
    private Collection $genre;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $synopsis = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $duration = null;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->director = new ArrayCollection();
        $this->genre = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName() . ' ' . $this->getReleaseYear();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setMovie($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getMovie() === $this) {
                $review->setMovie(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getReleaseYear(): ?int
    {
        return $this->release_year;
    }

    public function setReleaseYear(int $release_year): static
    {
        $this->release_year = $release_year;

        return $this;
    }

    /**
     * @return Collection<int, director>
     */
    public function getDirector(): Collection
    {
        return $this->director;
    }

    public function addDirector(Director $director): static
    {
        if (!$this->director->contains($director)) {
            $this->director->add($director);
        }

        return $this;
    }

    public function removeDirector(Director $director): static
    {
        $this->director->removeElement($director);

        return $this;
    }

    /**
     * @return Collection<int, genre>
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genre->contains($genre)) {
            $this->genre->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(?\DateTimeInterface $duration): static
    {
        $this->duration = $duration;

        return $this;
    }
}
