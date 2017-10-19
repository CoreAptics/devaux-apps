<?php

namespace BackBundle\Controller;

use CoreBundle\Entity\Departement;
use CoreBundle\Form\DepartementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DepartementController extends Controller
{
    public function listAction(){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:Departement')->findAll();

        return $this->render('@Back/Departement/list.html.twig', array(
            'entities'=>$entities
        ));
    }

    public function addAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $entity = new Departement();

        $form = $this->createForm(DepartementType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('back_departement_list');
        }

        return $this->render('@Back/Departement/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function editAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Departement')->find($id);

        $form = $this->createForm(DepartementType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->flush();
            return $this->redirectToRoute('back_departement_list');
        }

        return $this->render('@Back/Departement/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Departement')->find($id);
        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute('back_departement_list');
    }
}
