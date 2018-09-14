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
    
    namespace AppBundle\Service;

    use Symfony\Component\HttpFoundation\File\UploadedFile;

    /**
     * Description courte de la classe
     * Description longue de la classe, s'il y en a une
     * @version    Release: @package_version@
     * @since      Class available since Release xxx
     * @deprecated Class deprecated in Release xxx
     */
    class FileUploader
    {
        private $sTargetDirectory;
        
        public function __construct($_sTargetDirectory)
        {
            $this->sTargetDirectory = $_sTargetDirectory;
        }
        
        public function upload(UploadedFile $file)
        {
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getTargetDirectory(),$fileName);
            return $fileName;
        }
    
        /**
         * @return mixed
         */
        public function getTargetDirectory()
        {
            return $this->sTargetDirectory;
        }
    }