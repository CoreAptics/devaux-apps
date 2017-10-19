<?php

namespace BackBundle\Controller;

use CoreBundle\Entity\Ville;
use CoreBundle\Form\VilleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VilleController extends Controller
{
    public function listAction(){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:Ville')->findAll();

        return $this->render('@Back/Ville/list.html.twig', array(
            'entities'=>$entities
        ));
    }

    public function addAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $entity = new Ville();

        $form = $this->createForm(VilleType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('back_ville_list');
        }

        return $this->render('@Back/Ville/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function editAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Ville')->find($id);

        $form = $this->createForm(VilleType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->flush();
            return $this->redirectToRoute('back_ville_list');
        }

        return $this->render('@Back/Ville/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Ville')->find($id);
        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute('back_ville_list');
    }
}
