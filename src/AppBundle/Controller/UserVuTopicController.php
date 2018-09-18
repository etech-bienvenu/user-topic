<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Topic;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UserVuTopicController extends Controller
{
    /**
     * @Method("GET")
     * @Route("/addVisitor/{topicId}",requirements={"topicId"="\d+"},name="vu_topic_add_visitor")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param $topicId
     */
    public function addVisitorAction($topicId)
    {
        $em = $this->getDoctrine()->getManager();
        $topic = $em->getRepository(Topic::class)->find($topicId);
    
        $users = $em->getRepository('AppBundle:User')->findAll();
    
        return $this->render('user/add-viewers.html.twig', array(
            'users' => $users,
            'topic' => $topic,
        ));
    }
    
    /**
     * @Method("POST")
     * @Route("/postVisitor",name="post_visitor")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @param Request $request
     * @throws \Exception
     */
    public function postVisitorAction(Request $request)
    {
        $aUsersId = $request->request->get('users');
        $iTopicId = $request->request->get('topicId');
        
        $em = $this->getDoctrine()->getManager();
        
        $oTopic = $em->getRepository(Topic::class)->find($iTopicId);
        
        $userRepository = $em->getRepository(User::class);
        
            foreach ($aUsersId as $id) {
                $object = $userRepository->find($id);
               $oTopic->addViewer($object);
              
            }
            
        $em->flush();
        return $this->redirectToRoute('topics_index');
    }

}
