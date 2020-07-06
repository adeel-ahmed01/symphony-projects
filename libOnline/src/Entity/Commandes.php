<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
class Commandes
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $livre;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="date")
     */
    private $dateCommande;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="date")
     */
    private $dateLivraison;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTTC;


    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): self
    {
        $this->livre = $livre;
        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

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

}
