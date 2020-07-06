<?php

namespace App\Entity;

use App\Repository\FacturesRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FacturesRepository::class)
 */
class Factures
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $datepaiement;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTotal;

    /**
     * @ORM\OneToOne(targetEntity=Livre::class, mappedBy="facture", cascade={"persist", "remove"})
     */
    private $livre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatepaiement(): ?\DateTimeInterface
    {
        return $this->datepaiement;
    }


    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(float $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(Livre $livre): self
    {
        $this->livre = $livre;

        // set the owning side of the relation if necessary
        if ($livre->getFacture() !== $this) {
            $livre->setFacture($this);
        }

        return $this;
    }
}
