<?php
/**
 * Created by PhpStorm.
 * User: PC-Guillaume
 * Date: 03/04/2018
 * Time: 11:46
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Chambre;
use AppBundle\Form\Type\ChambreType;

/**
 * Class ChambreController
 * @package AppBundle\Controller
 * @Route("/chambre")
 */
class ChambreController extends Controller
{
    /**
     * @param Request $request
     * @Route("/")
     * @Template("AppBundle:Chambre:index.html.twig")
     */
    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $chambres = $em->getRepository('AppBundle:Chambre')->findAll();

        $chambre = new Chambre();
        $form = $this->createForm(new ChambreType(), $chambre);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();

            return $this->redirectToRoute('app_chambre_index');
        }

        return array(
            'chambres' => $chambres,
            'form'   => $form->createView(),
        );
    }

    /**
     * Edits an existing Chambre entity.
     *
     * @Route("/{id}/update", requirements={"id"="\d+"})
     * @Method("GET")
     * @Template("AppBundle:Chambre:update.html.twig")
     */
    public function updateAction(Chambre $chambre, Request $request)
    {
        $editForm = $this->createForm(new ChambreType(), $chambre, array(
            'action' => $this->generateUrl('app_chambre_update', array('id' => $chambre->getId())),
            'method' => 'GET',
        ));

        if ($editForm->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();

            return $this->redirect($this->generateUrl('app_chambre_index'));
        }

        return array(
            'chambre' => $chambre,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Deletes a Chambre entity.
     *
     * @Route("/{id}/delete", requirements={"id"="\d+"})
     * @Method("GET|POST")
     */
    public function deleteAction(Chambre $chambre, Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $chambre = $this->getDoctrine()->getRepository('AppBundle:Chambre')->find($id);

        $em->remove($chambre);
        $em->flush();

        return $this->redirect($this->generateUrl('app_chambre_index'));
    }

}