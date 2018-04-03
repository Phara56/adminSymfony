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
 * @Route("/moncompte")
 */
class MonCompteController extends Controller
{
  /**
  * @Route("/")
  * @Method("GET|POST")
  * @Template("AppBundle:User:monCompte.html.twig")
  */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $users = $em->getRepository('AppBundle:User')->findAll();

    return array(
      'Username' => $this->getUser()->getUsername(),
      'Email' => $this->getUser()->GetEMail(),
      'LastConnexion' => $this->getUser()->getLastLogin(),
    );
  }
}
