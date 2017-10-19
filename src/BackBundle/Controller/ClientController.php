<?php

namespace BackBundle\Controller;

use CoreBundle\Entity\Client;
use CoreBundle\Form\ClientAdminType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    public function listAction(){
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:Client')->findAll();

        return $this->render('@Back/Client/list.html.twig', array(
            'entities'=>$entities
        ));
    }

    public function addAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $entity = new Client();

        $form = $this->createForm(ClientAdminType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('back_client_list');
        }

        return $this->render('@Back/Client/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function editAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Client')->find($id);

        $form = $this->createForm(ClientAdminType::class, $entity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->flush();
            return $this->redirectToRoute('back_client_list');
        }

        return $this->render('@Back/Client/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Client')->find($id);
        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute('back_client_list');
    }
}
