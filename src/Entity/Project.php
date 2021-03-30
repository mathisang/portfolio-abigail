<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository", repositoryClass=ProjectRepository::class)
 */
class Project
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $theme;

    /**
     * @ORM\Column(type="date")
     */
    private $date_project;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PicturesProjet", mappedBy="projet", orphanRemoval=true, cascade={"persist"})
     */
    private $picturesProjets;

    /**
     * @Assert\All({
     *   @Assert\Image(mimeTypes="image/jpeg")
     * })
     */
    private $filePictures;

    public function __construct()
    {
        $this->picturesProjets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getDateProject(): ?\DateTimeInterface
    {
        return $this->date_project;
    }

    public function setDateProject(\DateTimeInterface $date_project): self
    {
        $this->date_project = $date_project;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection|PicturesProjet[]
     */
    public function getPicturesProjets(): Collection
    {
        return $this->picturesProjets;
    }

    public function addPicturesProjet(PicturesProjet $picturesProjet): self
    {
        if (!$this->picturesProjets->contains($picturesProjet)) {
            $this->picturesProjets[] = $picturesProjet;
            $picturesProjet->setProjet($this);
        }

        return $this;
    }

    public function removePicturesProjet(PicturesProjet $picturesProjet): self
    {
        if ($this->picturesProjets->removeElement($picturesProjet)) {
            // set the owning side to null (unless already changed)
            if ($picturesProjet->getProjet() === $this) {
                $picturesProjet->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilePictures()
    {
        return $this->filePictures;
    }

    /**
     * @param mixed $filePictures
     * @return Project
     */
    public function setFilePictures($filePictures): self
    {
        foreach($filePictures as $filePicture) {
            $picture = new PicturesProjet();
            $picture->setImageFile($filePicture);
            $this->addPicturesProjet($picture);
        }
        $this->picturesProjets = $filePictures;
        return $this;
    }
}
