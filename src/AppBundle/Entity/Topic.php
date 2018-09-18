<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TopicRepository")
 */
class Topic
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
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id",nullable=false)
     */
    private $oUser;
    
    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UserVuTopic",
     *     mappedBy="oTopic",cascade={"all"},
     *     orphanRemoval=true,fetch="EAGER")
     */
    private $aUserVueTopics;
    
    /**
     * Topic constructor.
     */
    public function __construct()
    {
        $this->aUserVueTopics = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Topic
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * @return mixed
     */
    public function getAUserVueTopics()
    {
        return $this->aUserVueTopics;
    }
    
    /**
     * @param mixed $aUserVueTopics
     */
    public function setAUserVueTopics($aUserVueTopics)
    {
        $this->aUserVueTopics = $aUserVueTopics;
    }
    
    /**
     * @return User
     */
    public function getOUser()
    {
        return $this->oUser;
    }
    
    /**
     * @param User $oUser
     */
    public function setOUser($oUser)
    {
        $this->oUser = $oUser;
    }
    
    public function addViewer($oUser){
        if($this->aUserVueTopics->contains($oUser)){
            return;
        }else{
            $userVueTopic = new UserVuTopic();
            $userVueTopic->setOTopic($this);
            $userVueTopic->setOUser($oUser);
            
            $this->aUserVueTopics->add($userVueTopic);
        }
    }
    
    public function removeViewer(User $oUser){
        $this->aUserVueTopics->removeElement($oUser);
    }
}

