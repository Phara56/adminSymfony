<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 28/03/2018
 * Time: 19:30
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Chambre;

/**
 * Class AccueilController
 * @package AppBundle\Controller
 * @Route("/accueil")
 */
class AccueilController extends Controller
{
     /**
     * @param Request $request
     * @Route("/")
     * @Template("AppBundle:Accueil:index.html.twig")
     */
    public function indexAction(Request $request){
        /*$repositoryAllChambre = $this->getDoctrine()->getRepository(Chambre::class);
        $query = $repositoryAllChambre->createQueryBuilder('c')
            ->getQuery();
        $allChambres = $query->getArrayResult();

        echo json_encode($allChambres);*/

        $currentRole =  $this->getUser()->getRoles()[0];

        $em = $this->getDoctrine()->getManager();
        $hotels = $em->getRepository('AppBundle:Hotel')->findAll();

        $repository = $this->getDoctrine()->getRepository(Chambre::class);

        $query = $repository->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery();
        $chambres = $query->getResult();

        return array(
            'username' => $this->getUser()->getUsername(),
            'chambres' => $chambres,
            'hotels' =>$hotels,
            'role' => $currentRole,
        );
    }

    /**
     * @param Request $request
     * @Route("/error")
     * @Template("AppBundle:Accueil:errorRole.html.twig")
     */
    public function errorroleAction(Request $request){

    }
}