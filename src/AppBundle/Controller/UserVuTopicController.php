<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Topic;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
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
        $author = $topic->getOUser();
        $viewers = $topic->getViewers();
        $users = $em->getRepository('AppBundle:User')->findAll();
        
        $usersNotViewTopic = [];
        foreach ($users as $user){
            if(!$this->contains($viewers,$user) && $user->getId()!==$author->getId()){
                array_push($usersNotViewTopic,$user);
            }
        }
        
        
        return $this->render('user/add-viewers.html.twig', array(
            'users' => $usersNotViewTopic,
            'topic' => $topic,
            'author'=>$author,
        ));
    }
    
    private function contains($users,User $user){
        $exist = false;
        foreach ($users as $u){
            if ($u->getId()===$user->getId()){
                $exist=true;
            }
        }
        return $exist;
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
    
    /**
     * @Method("POST")
     * @Route("/searchTopic",name="search_topic")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param Request $request
     */
    public function searchTopicAction(Request $request){
        $topicTitle = $request->request->get('topicTitle');
        $authorId = $request->request->get('authorId');
        $user = $this->getDoctrine()->getRepository(User::class)->find($authorId);
        
        $topic = $this->getDoctrine()->getRepository(Topic::class)
                            ->findOneBy(['title'=>$topicTitle,'oUser'=>$user]);
        
        $viewers = [];
        
                foreach ($topic->getViewers() as $viewer){
                    array_push($viewers,$viewer->getOUser());
                }
                
                array_push($viewers,$topic->getOUser());
                
                return $this->render('/topic/topic_search.html.twig', array(
                    'topic' => $topic,
                    'viewers' => $viewers,
                    'author'=>$topic->getOUser(),
                ));
       
    }

}
