<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("users")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="users_index")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param Request $request
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();
        $users = $this->get('knp_paginator')->paginate($users,$request->query->get('page',1),3);
        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }
    
    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="users_new")
     * @Method({"GET", "POST"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @param Request $request
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('users_show', array('id' => $user->getId()));
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="users_show")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param User $user
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="users_edit")
     * @Method({"GET", "POST"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @param Request $request
     * @param User $user
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('users_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="users_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('users_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('users_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
