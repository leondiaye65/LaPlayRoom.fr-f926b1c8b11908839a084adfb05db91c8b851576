<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use App\Service\LaPlayRoomAppInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass=ThemeRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *     fields={"nom"},
 *     message="Ce thème existe déjà dans le système"
 * )
 * @Vich\Uploadable
 */
class Theme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message=" Veuillez renseigner le nom du Thème svp")
     * @Assert\Length(max="50", maxMessage="Le nom de ce Thème ne doit pas excéder 50 catracères")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $top5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $nomPhoto;

    /**
     * @var File|null
     *  @Vich\UploadableField(mapping="img_themes", fileNameProperty="nomPhoto")
     */
    private $fichierPhoto;

   /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Gedmo\Slug(fields={"nom"})
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Rubrique::class, inversedBy="themes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rubrique;

    /**
     * @ORM\ManyToOne(targetEntity=Commentaire::class, inversedBy="themes")
     */
    private $commentaire;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTop5(): ?string
    {
        return $this->top5;
    }

    public function setTop5(string $top5): self
    {
        $this->top5 = $top5;

        return $this;
    }

    public function getNomPhoto(): ?string
    {
        return $this->nomPhoto;
    }

    public function setNomPhoto(string $nomPhoto): self
    {
        $this->nomPhoto = $nomPhoto;

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

        if (null !== $fichierPhoto) {

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

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    /**
     * @ORM\PrePersist
     */
    public function beforePersiste()
    {
        $this->nom = LaPlayRoomAppInterface::capitalize($this->nom);
        $this->createdAt = new DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function beforeUpdate()
    {
        $this->nom = LaPlayRoomAppInterface::capitalize($this->nom);
        $this->updatedAt = new DateTime();
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getRubrique(): ?Rubrique
    {
        return $this->rubrique;
    }

    public function setRubrique(?Rubrique $rubrique): self
    {
        $this->rubrique = $rubrique;

        return $this;
    }

    public function getCommentaire(): ?Commentaire
    {
        return $this->commentaire;
    }

    public function setCommentaire(?Commentaire $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}

