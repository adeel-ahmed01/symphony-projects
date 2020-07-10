<?php

namespace App\Entity;

use App\Repository\ArticleCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleCommandeRepository::class)
 */
class ArticleCommande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Commandes::class, inversedBy="articleCommandes")
     */
    private $commande;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer")
     */
    private $livreId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommande(): ?Commandes
    {
        return $this->commande;
    }

    public function setCommande(?Commandes $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
    

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getLivreId(): ?int
    {
        return $this->livreId;
    }

    public function setLivreId(int $livreId): self
    {
        $this->livreId = $livreId;

        return $this;
    }

}
