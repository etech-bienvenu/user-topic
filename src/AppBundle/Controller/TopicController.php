<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Topic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Topic controller.
 *
 * @Route("topics")
 */
class TopicController extends Controller
{
    /**
     * Lists all topic entities.
     *
     * @Route("/", name="topics_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $topics = $em->getRepository('AppBundle:Topic')->findAll();

        return $this->render('topic/index.html.twig', array(
            'topics' => $topics,
        ));
    }
    
    /**
     * Creates a new topic entity.
     *
     * @Route("/new", name="topics_new")
     * @Method({"GET", "POST"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @param Request $request
     */
    public function newAction(Request $request)
    {
        $topic = new Topic();
        $form = $this->createForm('AppBundle\Form\TopicType', $topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($topic);
            $em->flush();

            return $this->redirectToRoute('topics_show', array('id' => $topic->getId()));
        }

        return $this->render('topic/new.html.twig', array(
            'topic' => $topic,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Finds and displays a topic entity.
     *
     * @Route("/{id}", name="topics_show")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param Topic $topic
     */
    public function showAction(Topic $topic)
    {
        $deleteForm = $this->createDeleteForm($topic);

        return $this->render('topic/show.html.twig', array(
            'topic' => $topic,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing topic entity.
     *
     * @Route("/{id}/edit", name="topics_edit")
     * @Method({"GET", "POST"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @param Request $request
     * @param Topic $topic
     */
    public function editAction(Request $request, Topic $topic)
    {
        $deleteForm = $this->createDeleteForm($topic);
        $editForm = $this->createForm('AppBundle\Form\TopicType', $topic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('topics_edit', array('id' => $topic->getId()));
        }

        return $this->render('topic/edit.html.twig', array(
            'topic' => $topic,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Deletes a topic entity.
     *
     * @Route("/{id}", name="topics_delete")
     * @Method("DELETE")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @param Request $request
     * @param Topic $topic
     */
    public function deleteAction(Request $request, Topic $topic)
    {
        $form = $this->createDeleteForm($topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($topic);
            $em->flush();
        }

        return $this->redirectToRoute('topics_index');
    }

    /**
     * Creates a form to delete a topic entity.
     *
     * @param Topic $topic The topic entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Topic $topic)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('topics_delete', array('id' => $topic->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * @Route("/{id}/viewers",name="topics_viewer")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param $id
     */
    public function addVisitor($id){
        $em = $this->getDoctrine()->getManager();
    
        $users = $em->getRepository('AppBundle:User')->findAll();
        $topic = $em->getRepository(Topic::class)->find($id);
        //$topic->addViewer()
        return $this->render('user/add-viewers.html.twig', array(
            'users' => $users,
            'topic' => $topic
        ));
    }
    
    /**
     * @Route("/viewers",name="post_viewer")
     * @Method("POST")
     * @return Response
     * @param Request $request
     * @param $id
     */
    public function postVisitors(Request $request,$id){
        $data = $request->request->all();
        
        return $this->render('user/post-viewers',array(
            'data'=>$data,
        ));
    }
}
