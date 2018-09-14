<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserVuTopic
 *
 * @ORM\Table(name="user_vu_topic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserVuTopicRepository")
 */
class UserVuTopic
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
     * @var User
     * @ORM\Column(name="user_id",nullable=false)
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $oUser;
    
    /**
     * @var Topic
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Topic",inversedBy="aUserVueTopics")
     * @ORM\JoinColumn(name="topic_id",nullable=false,referencedColumnName="id")
     */
    private $oTopic;
    
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
    
    /**
     * @return Topic
     */
    public function getOTopic()
    {
        return $this->oTopic;
    }
    
    /**
     * @param Topic $oTopic
     */
    public function setOTopic($oTopic)
    {
        $this->oTopic = $oTopic;
    }
    
    
    
}

