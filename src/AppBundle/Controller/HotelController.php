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
use AppBundle\Entity\Hotel;
use AppBundle\Form\Type\HotelType;

/**
 * Class HotelController
 * @package AppBundle\Controller
 * @Route("/hotel")
 */
class HotelController extends Controller
{
    /**
     * @param Request $request
     * @Route("/")
     * @Template("AppBundle:Hotel:index.html.twig")
     */
    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $hotels = $em->getRepository('AppBundle:Hotel')->findAll();

        $hotel = new Hotel();
        $form = $this->createForm(new HotelType(), $hotel);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();

            return $this->redirectToRoute('app_hotel_index');
        }

        return array(
            'hotels' => $hotels,
            'form'   => $form->createView(),
        );
    }

    /**
     * Edits an existing Hotel entity.
     *
     * @Route("/{id}/update", requirements={"id"="\d+"})
     * @Method("GET")
     * @Template("AppBundle:Hotel:update.html.twig")
     */
    public function updateAction(Hotel $hotel, Request $request)
    {
        $editForm = $this->createForm(new HotelType(), $hotel, array(
            'action' => $this->generateUrl('app_hotel_update', array('id' => $hotel->getId())),
            'method' => 'GET',
        ));

        if ($editForm->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();

            return $this->redirect($this->generateUrl('app_hotel_index'));
        }

        return array(
            'hotel' => $hotel,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Deletes a Hotel entity.
     *
     * @Route("/{id}/delete", requirements={"id"="\d+"})
     * @Method("GET|POST")
     */
    public function deleteAction(Hotel $hotel, Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $hotel = $this->getDoctrine()->getRepository('AppBundle:Hotel')->find($id);

        $em->remove($hotel);
        $em->flush();

        return $this->redirect($this->generateUrl('app_hotel_index'));
    }

}