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

        return array();
    }
}