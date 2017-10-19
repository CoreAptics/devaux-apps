<?php

namespace BackBundle\Controller;

use CoreBundle\Entity\Country;
use CoreBundle\Form\CountryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaysController extends Controller
{
    public function listAction(){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:Country')->findAll();

        return $this->render('@Back/Pays/list.html.twig', array(
            'entities'=>$entities
        ));
    }

    public function addAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $entity = new Country();

        $form = $this->createForm(CountryType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('back_pays_list');
        }

        return $this->render('@Back/Pays/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function editAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Country')->find($id);

        $form = $this->createForm(CountryType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->flush();
            return $this->redirectToRoute('back_pays_list');
        }

        return $this->render('@Back/Pays/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Country')->find($id);
        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute('back_pays_list');
    }
}
