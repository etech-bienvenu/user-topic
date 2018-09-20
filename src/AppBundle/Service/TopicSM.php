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
    
    
    use AppBundle\Entity\Topic;
    use AppBundle\Entity\User;

    interface TopicSM
    {
        public function saveTopic(User $user,Topic $topic);
    
        /**
         * Lister tous les utilisateurs qui ont deja vu le topic
         * @return mixed
         * @param Topic $topic
         */
        public function findUsersViewedTopic(Topic $topic);
    
        /**
         * DESCRIPTION function
         * @return mixed
         * @param Topic $topic
         */
        public function findUserNotViewTopic(Topic $topic);
    }