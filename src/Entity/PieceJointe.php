<?php

namespace App\Entity;

use App\Repository\PieceJointeRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=PieceJointeRepository::class)
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks
 */
class PieceJointe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="piece_jointes", fileNameProperty="nomImage")
     * @var File|null
     */
    private $fichierPhoto;

    /**
     * @ORM\Column(type="string")
     */
    private $nomPhoto;

    /**
     * @ORM\ManyToOne(targetEntity=Theme::class, inversedBy="piece_jointes")
     */
    private $theme;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     *  @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPhoto(): ?string
    {
       return $this->nomPhoto;
    }

    public function setNomPhoto(?string $nomPhoto): self
    {
       $this->nomPhoto = $nomPhoto;
       return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
       return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt()
    {
       return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): self
    {
      $this->updatedAt = $updatedAt;

      return $this;
    }

    /**
     * @return File|null
     */

    public function getFichierPhoto(): ?File
    {
       return $this->fichierPhoto;
    }

    /**
     * @param File|null $fichierPhoto
     */
    public function setFichierPhoto(?File $fichierPhoto): void
    {
       $this->fichierPhoto = $fichierPhoto;
       if(null === $fichierPhoto) {
           $this->updatedAt = new DateTime();
       }
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTheme(): ?Theme
    {
      return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
      $this->theme = $theme;
      return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function beforePersiste()
    {
     $this->createdAt = new DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function beforeUpdate()
    {
        $this->updatedAt = new DateTime();
    }
}
