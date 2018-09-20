<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="30",maxMessage="Nom trop long")
     * @ORM\Column(name="nom", type="string", length=30)
     */
    private $nom;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="30",maxMessage="Prenom trop long")
     * @ORM\Column(name="prenom", type="string", length=30)
     */
    private $prenom;

    /**
     * @var
     * @Assert\NotBlank(message="SVP veuillez choisir un photo de profil")
     * @Assert\File(mimeTypes={"image/jpeg","image/png"})
     * @ORM\Column(name="photo", type="string", length=255, nullable=true, unique=true)
     */
    private $photo;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="30",maxMessage="Pseudo trop long")
     * @ORM\Column(name="pseudo", type="string", length=30, unique=true)
     */
    private $pseudo;
    
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="date_naissance",type="string",nullable=false)
     */
    private $dateNaissance;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom(){
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom) {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom(){
        return $this->prenom;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return User
     */
    public function setPhoto($photo) {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto(){
        return $this->photo;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return User
     */
    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo(){
        return $this->pseudo;
    }
    
    /**
     * @return string
     */
    public function getDateNaissance(){
        return $this->dateNaissance;
    }
    
    /**
     * @param string $dateNaissance
     */
    public function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }
    
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    
}

