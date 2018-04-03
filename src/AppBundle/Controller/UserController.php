<?php

namespace AppBundle\Controller;


use AppBundle\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * User controller.
 *
 * @Route("/admin/users")
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     * @Route("/", name="admin_users")
     * @Method("GET|POST")
     * @Template("AppBundle:User:accueil.html.twig")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:User')->findAll();

        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        if ($form->handleRequest($request)->isValid()) {
            $user->setEnabled(true);
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);

            return $this->redirect($this->generateUrl('admin_users'));
        }

        return array(
            'entities'  => $entities,
            'user' => $user,
            'form'   => $form->createView(),
        );
    }

    /**
     * Edits an existing User entity.
     *
     * @Route("/{id}/update", name="admin_users_update", requirements={"id"="\d+"})
     * @Method("GET")
     * @Template("AppBundle:User:update.html.twig")
     */
    public function updateAction(User $user, Request $request)
    {
        $editForm = $this->createForm(new UserType(), $user, array(
            'action' => $this->generateUrl('admin_users_update', array('id' => $user->getId())),
            'method' => 'GET',
            'passwordRequired' => false
        ));
        if ($editForm->handleRequest($request)->isValid()) {
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);

            return $this->redirect($this->generateUrl('admin_users', array('id' => $user->getId())));
        }

        return array(
            'user' => $user,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Deletes a User entity.
     *
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     * @Route("/{id}/delete", name="admin_users_delete", requirements={"id"="\d+"})
     * @Method("GET|POST")
     */
    public function deleteAction(User $user, Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);

        $em->remove($user);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_users'));
    }
}
