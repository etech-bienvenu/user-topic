<?php
    /**
     * Description courte du fichier
     * Description longue du fichier s'il y en a une
     * LICENSE: Informations sur la licence
     * @copyright  Copyright (c) 2011-2012 Council of Europe (www.coe.int)
     * @license    http://static.coe.int/licenses/lgpl
     * @version    $Id:$
     * @since      File available since Release xxx
     */
    
    namespace AppBundle\DTO;
    
    use Doctrine\Common\Collections\ArrayCollection;

    class TopicDTO
    {
        private $id;
        private $title;
        private $users;
        
        public function __construct(){
            $this->users = new ArrayCollection();
        }
    
        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }
    
        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }
    
        /**
         * @return mixed
         */
        public function getTitle()
        {
            return $this->title;
        }
    
        /**
         * @param mixed $title
         */
        public function setTitle($title)
        {
            $this->title = $title;
        }
    
        /**
         * @return ArrayCollection
         */
        public function getUsers()
        {
            return $this->users;
        }
    }