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
    
    class UserDTO
    {
        private $id;
        private $bIsSelected;
    
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
        public function getBIsSelected()
        {
            return $this->bIsSelected;
        }
    
        /**
         * @param mixed $bIsSelected
         */
        public function setBIsSelected($bIsSelected)
        {
            $this->bIsSelected = $bIsSelected;
        }
        
    }