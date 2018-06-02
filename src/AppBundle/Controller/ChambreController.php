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

            $file1 = $chambre->getImage1();
            if($file1 != null || $file1 != ''){
                $fileName1 = md5(uniqid()).'.'.$file1->guessExtension();
                $file1->move(
                    $this->container->getParameter('image_directory'),
                    $fileName1
                );
                $chambre->setImage1($fileName1);
            }else{
                $chambre->setImage1('');
            }

            $file2 = $chambre->getImage2();
            if($file2 != null || $file2 != '') {
                $fileName2 = md5(uniqid()) . '.' . $file2->guessExtension();
                $file2->move(
                    $this->container->getParameter('image_directory'),
                    $fileName2
                );
                $chambre->setImage2($fileName2);
            }else{
                $chambre->setImage2('');
            }

            $file3 = $chambre->getImage3();
            if($file3 != null || $file3 != '') {
                $fileName3 = md5(uniqid()) . '.' . $file3->guessExtension();
                $file3->move(
                    $this->container->getParameter('image_directory'),
                    $fileName3
                );
                $chambre->setImage3($fileName3);
            }else{
                $chambre->setImage3('');
            }

            $file4 = $chambre->getImage4();
            if($file4 != null || $file4 != '') {
                $fileName4 = md5(uniqid()) . '.' . $file4->guessExtension();
                $file4->move(
                    $this->container->getParameter('image_directory'),
                    $fileName4
                );
                $chambre->setImage4($fileName4);
            }else{
                $chambre->setImage4('');
            }

            $file5 = $chambre->getImage5();
            if($file5 != null || $file5 != '') {
                $fileName5 = md5(uniqid()) . '.' . $file5->guessExtension();
                $file5->move(
                    $this->container->getParameter('image_directory'),
                    $fileName5
                );
                $chambre->setImage5($fileName5);
            }else{
                $chambre->setImage5('');
            }

            $chambre->setDatepublication(new \DateTime('now'));

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

        $oldImg1 = $chambre->getImage1();
        $oldImg2 = $chambre->getImage2();
        $oldImg3 = $chambre->getImage3();
        $oldImg4 = $chambre->getImage4();
        $oldImg5 = $chambre->getImage5();

        if ($editForm->handleRequest($request)->isValid()) {

            /*$newImage1 = $request->get('chambre')['image1'];
            if($newImage1 != null || $newImage1 != ''){
                $fileName1 = md5(uniqid()).'.'.$newImage1->guessExtension();
                $newImage1->move(
                    $this->container->getParameter('image_directory'),
                    $fileName1
                );
                $chambre->setImage1($fileName1);
            }else{
                $chambre->setImage1('');
            }*/

            $chambre->setImage1($oldImg1);
            $chambre->setImage2($oldImg2);
            $chambre->setImage3($oldImg3);
            $chambre->setImage4($oldImg4);
            $chambre->setImage5($oldImg5);

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

    /**
     * Show a Chambre entity.
     *
     * @Route("/{id}/show", requirements={"id"="\d+"})
     * @Method("GET|POST")
     * @Template("AppBundle:Chambre:show.html.twig")
     */
    public function showAction(Chambre $chambre, Request $request, $id)
    {
        $chambre = $this->getDoctrine()->getRepository('AppBundle:Chambre')->find($id);

        return array(
          'chambre' => $chambre
        );
    }

}