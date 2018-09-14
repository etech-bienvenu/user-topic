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
    
    namespace AppBundle\EventListener;

    use AppBundle\Entity\User;
    use AppBundle\Service\FileUploader;
    use Doctrine\ORM\Event\LifecycleEventArgs;
    use Doctrine\ORM\Event\PreUpdateEventArgs;
    use Symfony\Component\HttpFoundation\File\File;
    use Symfony\Component\HttpFoundation\File\UploadedFile;

    /**
     * Description courte de la classe
     * Description longue de la classe, s'il y en a une
     * @version    Release: @package_version@
     * @since      Class available since Release xxx
     * @deprecated Class deprecated in Release xxx
     */
    class PhotoUploadListener
    {
        private $uploader;
        
        public function __construct(FileUploader $fileUploader)
        {
            $this->uploader = $fileUploader;
        }
    
        /**
         * DESCRIPTION function
         *
         * la declaration de  visisbilité doit être OBLIGATOIRE
         * @param LifecycleEventArgs $args
         */
        public function prePersist(LifecycleEventArgs $args)
        {
            $entity = $args->getEntity();
            $this->uploadFile($entity);
        }
        
        public function preUpdate(PreUpdateEventArgs $args)
        {
            $entity = $args->getEntity();
            $this->uploadFile($entity);
            
        }
        public function postLoad(LifecycleEventArgs $args)
        {
             $entity = $args->getEntity();
             if (!$entity instanceof  User){
                 return;
             }
             if ($fileName = $entity->getPhoto()){
                 $entity->setPhoto(new File($this->uploader->getTargetDirectory().'/'.$fileName));
             }
        }
        
        private function uploadFile($entity)
        {
            if (!$entity instanceof User){
                return;
            }
            
            $file = $entity->getPhoto();
            
            if ($file instanceof UploadedFile){
                $fileName = $this->uploader->upload($file);
                $entity->setPhoto($fileName);
                
            }elseif ($file instanceof File){
                $entity->setPhoto($file->getFilename());
            }
        }
    }