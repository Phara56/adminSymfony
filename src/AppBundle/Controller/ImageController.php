<?php
/**
 * Created by PhpStorm.
 * User: PC-Guillaume
 * Date: 03/04/2018
 * Time: 11:46
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use AppBundle\Form\Type\ImageType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HotelController
 * @package AppBundle\Controller
 * @Route("/image")
 */
class ImageController extends Controller
{
    /**
     * @param Request $request
     * @Route("/")
     * @Template("AppBundle:Image:index.html.twig")
     */
    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository('AppBundle:Image')->findAll();

        $image = new Image();
        $form = $this->createForm(new ImageType(), $image);

        if ($form->handleRequest($request)->isValid()) {

            $file = $image->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->container->getParameter('image_directory'),
                $fileName
            );
            $image->setImage($fileName);


            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('app_image_index');
        }

        return array(
            'images' => $images,
            'form'   => $form->createView(),
        );
    }
}