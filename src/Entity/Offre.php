<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OffreRepository")
 */
class Offre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $description;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\competence", inversedBy="offres")
     */
    private $id_competence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\job", inversedBy="offres")
     */
    private $id_job;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\contrat", inversedBy="offres")
     */
    private $contrat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Candidature", mappedBy="offre")
     */
    private $candidatures;

    public function __construct()
    {
        $this->id_competence = new ArrayCollection();
        $this->candidatures = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|competence[]
     */
    public function getIdCompetence(): Collection
    {
        return $this->id_competence;
    }

    public function addIdCompetence(competence $idCompetence): self
    {
        if (!$this->id_competence->contains($idCompetence)) {
            $this->id_competence[] = $idCompetence;
        }

        return $this;
    }

    public function removeIdCompetence(competence $idCompetence): self
    {
        if ($this->id_competence->contains($idCompetence)) {
            $this->id_competence->removeElement($idCompetence);
        }

        return $this;
    }

    public function getIdJob(): ?job
    {
        return $this->id_job;
    }

    public function setIdJob(?job $id_job): self
    {
        $this->id_job = $id_job;

        return $this;
    }

    public function getContrat(): ?contrat
    {
        return $this->contrat;
    }

    public function setContrat(?contrat $contrat): self
    {
        $this->contrat = $contrat;

        return $this;
    }

    /**
     * @return Collection|Candidature[]
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): self
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures[] = $candidature;
            $candidature->setOffre($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->candidatures->contains($candidature)) {
            $this->candidatures->removeElement($candidature);
            // set the owning side to null (unless already changed)
            if ($candidature->getOffre() === $this) {
                $candidature->setOffre(null);
            }
        }

        return $this;
    }
}
