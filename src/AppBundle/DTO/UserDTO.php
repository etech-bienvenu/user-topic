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
        private $nom;
        private $prenom;
        private $pseudo;
        private $dateNaissance;
        private $photo;
    
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
        public function getNom()
        {
            return $this->nom;
        }
    
        /**
         * @param mixed $nom
         */
        public function setNom($nom)
        {
            $this->nom = $nom;
        }
    
        /**
         * @return mixed
         */
        public function getPrenom()
        {
            return $this->prenom;
        }
    
        /**
         * @param mixed $prenom
         */
        public function setPrenom($prenom)
        {
            $this->prenom = $prenom;
        }
    
        /**
         * @return mixed
         */
        public function getPseudo()
        {
            return $this->pseudo;
        }
    
        /**
         * @param mixed $pseudo
         */
        public function setPseudo($pseudo)
        {
            $this->pseudo = $pseudo;
        }
    
        /**
         * @return mixed
         */
        public function getDateNaissance()
        {
            return $this->dateNaissance;
        }
    
        /**
         * @param mixed $dateNaissance
         */
        public function setDateNaissance($dateNaissance)
        {
            $this->dateNaissance = $dateNaissance;
        }
    
        /**
         * @return mixed
         */
        public function getPhoto()
        {
            return $this->photo;
        }
    
        /**
         * @param mixed $photo
         */
        public function setPhoto($photo)
        {
            $this->photo = $photo;
        }
        
        
    }