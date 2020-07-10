<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\JoinColumn;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
class Commandes
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $dateCommande;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $dateLivraison;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTTC;

    /**
     * @ORM\OneToMany(targetEntity=ArticleCommande::class, mappedBy="commande")
     */
    private $articleCommandes;

    /**
     * @ORM\OneToOne(targetEntity=Factures::class, cascade={"persist", "remove"})
     * @JoinColumn(name="facture_id", referencedColumnName="id", nullable=false)
     */
    private $facture;

    public function __construct()
    {
        $this->articleCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId( $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }


    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }


    public function getPrixTTC(): ?float
    {
        return $this->prixTTC;
    }

    public function setPrixTTC(float $prixTTC): self
    {
        $this->prixTTC = $prixTTC;

        return $this;
    }

    /**
     * @return Collection|ArticleCommande[]
     */
    public function getArticleCommandes(): Collection
    {
        return $this->articleCommandes;
    }

    public function addArticleCommandes(ArticleCommande $articleCommandes): self
    {
        if (!$this->articleCommandes->contains($articleCommandes)) {
            $this->articleCommandes[] = $articleCommandes;
            $articleCommandes->setCommande($this);
        }

        return $this;
    }

    public function removeArticleCommandes(ArticleCommande $articleCommandes): self
    {
        if ($this->articleCommandes->contains($articleCommandes)) {
            $this->articleCommandes->removeElement($articleCommandes);
            // set the owning side to null (unless already changed)
            if ($articleCommandes->getCommande() === $this) {
                $articleCommandes->setCommande(null);
            }
        }

        return $this;
    }

    public function getFacture(): ?Factures
    {
        return $this->facture;
    }

    public function setFacture(Factures $facture): self
    {
        $this->facture = $facture;

        return $this;
    }
}
