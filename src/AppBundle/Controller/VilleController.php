<?php
/**
 * Created by PhpStorm.
 * User: PC-Guillaume
 * Date: 03/04/2018
 * Time: 11:46
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Ville;
use AppBundle\Form\Type\VilleType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class VilleController
 * @package AppBundle\Controller
 * @Route("/ville")
 */
class VilleController extends Controller
{
    /**
     * @param Request $request
     * @Route("/")
     * @Template("AppBundle:Ville:index.html.twig")
     */
    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $villes = $em->getRepository('AppBundle:Ville')->findAll();

        $ville = new Ville();
        $form = $this->createForm(new VilleType(), $ville);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();

            return $this->redirectToRoute('app_ville_index');
        }

        return array(
            'villes' => $villes,
            'form'   => $form->createView(),
        );
    }

    /**
     * Edits an existing Vile entity.
     *
     * @Route("/{id}/update", requirements={"id"="\d+"})
     * @Method("GET")
     * @Template("AppBundle:Ville:update.html.twig")
     */
    public function updateAction(Ville $ville, Request $request)
    {
        $editForm = $this->createForm(new VilleType(), $ville, array(
            'action' => $this->generateUrl('app_ville_update', array('id' => $ville->getId())),
            'method' => 'GET',
        ));

        if ($editForm->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();

            return $this->redirect($this->generateUrl('app_ville_index'));
        }

        return array(
            'ville' => $ville,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Deletes a Ville entity.
     *
     * @Route("/{id}/delete", requirements={"id"="\d+"})
     * @Method("GET|POST")
     */
    public function deleteAction(Ville $ville, Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $ville = $this->getDoctrine()->getRepository('AppBundle:Ville')->find($id);

        $em->remove($ville);
        $em->flush();

        return $this->redirect($this->generateUrl('app_ville_index'));
    }

}