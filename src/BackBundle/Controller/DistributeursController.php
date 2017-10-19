<?php

namespace BackBundle\Controller;

use CoreBundle\Entity\Category;
use CoreBundle\Entity\Reference;
use CoreBundle\Form\CategoryType;
use CoreBundle\Form\ReferenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DistributeursController extends Controller
{
    public function listAction(){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:Reference')->findAll();

        return $this->render('@Back/Reference/list.html.twig', array(
            'entities'=>$entities
        ));
    }

    public function addAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $entity = new Reference();
        $form = $this->createForm(ReferenceType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('back_reference_list');
        }

        return $this->render('@Back/Reference/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function editAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Reference')->find($id);

        $form = $this->createForm(ReferenceType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->flush();
            return $this->redirectToRoute('back_reference_list');
        }

        return $this->render('@Back/Reference/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Reference')->find($id);
        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute('back_reference_list');
    }

    public function categoryListAction(){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:Category')->findAll();

        return $this->render('@Back/Category/list.html.twig', array(
            'entities'=>$entities
        ));
    }

    public function categoryAddAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $entity = new Category();
        $form = $this->createForm(CategoryType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('back_reference_category_list');
        }

        return $this->render('@Back/Category/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function categoryEditAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Category')->find($id);

        $form = $this->createForm(CategoryType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->flush();
            return $this->redirectToRoute('back_reference_category_list');
        }

        return $this->render('@Back/Category/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function categoryDeleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Category')->find($id);
        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute('back_reference_category_list');
    }
}
