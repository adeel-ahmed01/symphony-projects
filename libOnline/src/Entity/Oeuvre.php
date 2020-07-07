<?php

namespace App\Entity;

use App\Repository\OeuvreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OeuvreRepository::class)
 */
class Oeuvre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $editeur;

    /**
     * @ORM\OneToMany(targetEntity=Livre::class, mappedBy="oeuvre")
     */
    private $livres;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="oeuvres")
     */
    private $thematique;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
        $this->thematique = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    public function setEditeur(string $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->livres->contains($livre)) {
            $this->livres[] = $livre;
            $livre->setOeuvre($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->livres->contains($livre)) {
            $this->livres->removeElement($livre);
            // set the owning side to null (unless already changed)
            if ($livre->getOeuvre() === $this) {
                $livre->setOeuvre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getThematique(): Collection
    {
        return $this->thematique;
    }

    public function addThematique(Categorie $thematique): self
    {
        if (!$this->thematique->contains($thematique)) {
            $this->thematique[] = $thematique;
        }

        return $this;
    }

    public function removeThematique(Categorie $thematique): self
    {
        if ($this->thematique->contains($thematique)) {
            $this->thematique->removeElement($thematique);
        }

        return $this;
    }
}
