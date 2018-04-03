<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 15/03/2018
 * Time: 14:27
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Outil;
use AppBundle\Entity\Tag;
use AppBundle\Form\Type\OutilType;
use AppBundle\Form\Type\TagType;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Outil controller.
 *
 * @Route("/")
 */
class OutilController extends Controller
{
    /**
     * @Route("outil/")
     * @Template("AppBundle:Outil:index.html.twig")
     */
    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Outil')->findAll();

        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('AppBundle:Tag')->findAll();

        $searchWords = "";
        $searchWords = $request->query->get('search');

        if($searchWords != ''){
            /*$req1 = 'SELECT * FROM outil WHERE nom LIKE "%'.$searchWords.'%"';*/
            $req1 = 'SELECT * FROM outil WHERE nom LIKE "%'.$searchWords.'%" OR description LIKE "%'.$searchWords.'%"';
            $stmt1 = $this->getDoctrine()->getConnection()->prepare($req1);
            $stmt1->execute([]);
        }else{
            $req1 = 'SELECT * FROM outil';
            $stmt1 = $this->getDoctrine()->getConnection()->prepare($req1);
            $stmt1->execute([]);
        }

        $req = 'SELECT outil.id, tag.name FROM outil, outil_tag, tag WHERE outil_tag.outil_id = outil.id AND outil_tag.tag_id = tag.id;';
        $stmt = $this->getDoctrine()->getConnection()->prepare($req);
        $stmt->execute([]);

        return array(
            'entities'  => $entities,
            'tags' => $tags,
            'outilsTag' => $stmt->fetchAll(),
            'searchWords' => $searchWords,
            'reqOutils' => $stmt1->fetchAll(),
            );
    }

    /**
     * @Route("admin/outil/")
     * @Template("AppBundle:Outil:indexAdmin.html.twig")
     */
    public function indexAdminAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Outil')->findAll();

        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('AppBundle:Tag')->findAll();

        $req = 'SELECT outil.id, tag.name FROM outil, outil_tag, tag WHERE outil_tag.outil_id = outil.id AND outil_tag.tag_id = tag.id;';
        $stmt = $this->getDoctrine()->getConnection()->prepare($req);
        $stmt->execute([]);

        $outil = new Outil();
        $tag = new Tag();

        $form = $this->createForm(new OutilType(), $outil);
        $formTag = $this->createForm(new TagType(), $tag);

        if ($form->handleRequest($request)->isValid()) {
            $dateNow =  (new \DateTime());
            $outil->setDatePublication($dateNow);
            $tagId = $request->get('outil')["tags"];
            $tagOutil = $this->getDoctrine()->getRepository(Tag::class)->find($tagId);
            $outil->addTag($tagOutil);
            $em = $this->getDoctrine()->getManager();
            $em->persist($outil);
            $em->flush();

            return $this->redirectToRoute('app_outil_indexadmin');
        }

        if ($formTag->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();
            return $this->redirectToRoute('app_outil_indexadmin');
        }

        return array(
            'username' =>$this->getUser()->getUsername(),
            'lastlogin' => $this->getuser()->getLastLogin(),
            'outilsTag' => $stmt->fetchAll(),
            'entities'  => $entities,
            'outil' => $outil,
            'form'   => $form->createView(),
            'tags'  => $tags,
            'tag' => $tag,
            'formTag'   => $formTag->createView(),
        );
    }

    /**
     * Edits an existing Outil entity.
     *
     * @Route("/{id}/update", requirements={"id"="\d+"})
     * @Method("GET")
     * @Template("AppBundle:Outil:update.html.twig")
     */
    public function updateAction(Outil $outil, Request $request)
    {
        $editForm = $this->createForm(new OutilType(), $outil, array(
            'action' => $this->generateUrl('app_outil_update', array('id' => $outil->getId())),
            'method' => 'GET',
        ));

        if ($editForm->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($outil);
            $em->flush();

            return $this->redirect($this->generateUrl('app_outil_indexadmin'));
        }

        return array(
            'outil' => $outil,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Tag entity.
     *
     * @Route("/{id}/updatetag", requirements={"id"="\d+"})
     * @Method("GET")
     * @Template("AppBundle:Outil:updateTag.html.twig")
     */
    public function updateTagAction(Tag $tag, Request $request)
    {
        $editForm = $this->createForm(new TagType(), $tag, array(
            'action' => $this->generateUrl('app_outil_updatetag', array('id' => $tag->getId())),
            'method' => 'GET',
        ));

        if ($editForm->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirect($this->generateUrl('app_outil_indexadmin'));
        }

        return array(
            'tag' => $tag,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Deletes a Outil entity.
     *
     * @Route("/{id}/delete", requirements={"id"="\d+"})
     * @Method("GET|POST")
     */
    public function deleteAction(Outil $outil, Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $outil = $this->getDoctrine()->getRepository('AppBundle:Outil')->find($id);

        $em->remove($outil);
        $em->flush();

        return $this->redirect($this->generateUrl('app_outil_indexadmin'));
    }

    /**
     * Deletes a Tag entity.
     *
     * @Route("/{id}/deletetag", requirements={"id"="\d+"})
     * @Method("GET|POST")
     */
    public function deleteTagAction(Tag $tag, Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $tag = $this->getDoctrine()->getRepository('AppBundle:Tag')->find($id);

        $em->remove($tag);
        $em->flush();

        return $this->redirect($this->generateUrl('app_outil_indexadmin'));
    }

    /**
     * @Route("outil/getoutil")
     */
    public function getoutilAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Outil::class);

        $searchWords = "";
        //Récupère la valeur du champ de recherche
        $searchWords = $request->query->get('search');


        $outilsQuery = $repository
            ->createQueryBuilder('o');

        $query = $outils = $outilsQuery
            ->getQuery();
        $outils = $query->getResult();

        $arrayOutils = array();
        foreach ($outils as $key => $value) {
            $outil = array();
            $outil["nom"] = $value->getNom();
            $outil["description"] = $value->getDescription();
            array_push($arrayOutils,$outil);
        }

        return  new JsonResponse($arrayOutils);
    }
}