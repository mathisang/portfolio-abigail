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

    /**
     * @ORM\ManyToMany(targetEntity=Outils::class, inversedBy="projects")
     */
    private $outils;

    /**
     * @ORM\ManyToOne(targetEntity=Themes::class, inversedBy="projects")
     */
    private $theme;

    /**
     * @ORM\ManyToMany(targetEntity=Competences::class, inversedBy="projects")
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity=Notions::class, inversedBy="projects")
     */
    private $notions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    public function __construct()
    {
        $this->picturesProjets = new ArrayCollection();
        $this->outils = new ArrayCollection();
        $this->competences = new ArrayCollection();
        $this->notions = new ArrayCollection();
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

    /**
     * @return Collection<int, Outils>
     */
    public function getOutils(): Collection
    {
        return $this->outils;
    }

    public function addOutil(Outils $outil): self
    {
        if (!$this->outils->contains($outil)) {
            $this->outils[] = $outil;
        }

        return $this;
    }

    public function removeOutil(Outils $outil): self
    {
        $this->outils->removeElement($outil);

        return $this;
    }

    public function getTheme(): ?Themes
    {
        return $this->theme;
    }

    public function setTheme(?Themes $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return Collection<int, Competences>
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competences $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): self
    {
        $this->competences->removeElement($competence);

        return $this;
    }

    /**
     * @return Collection<int, Notions>
     */
    public function getNotions(): Collection
    {
        return $this->notions;
    }

    public function addNotion(Notions $notion): self
    {
        if (!$this->notions->contains($notion)) {
            $this->notions[] = $notion;
        }

        return $this;
    }

    public function removeNotion(Notions $notion): self
    {
        $this->notions->removeElement($notion);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
