<?php

namespace BackBundle\Controller;

use CoreBundle\Form\ParameterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ParameterController extends Controller
{
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $parameterList  = $em->getRepository('CoreBundle:Parameter')->findAll();

        return $this->render('@Back/Parameter/list.html.twig', array(
            'parameterList'=>$parameterList
        ));
    }

    public function editAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();

        $parameter = $em->getRepository('CoreBundle:Parameter')->find($id);
        $form = $this->createForm(ParameterType::class, $parameter);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->flush();
            return $this->redirectToRoute('back_parameter_list');
        }
        return $this->render('@Back/Parameter/add.html.twig', array(
            'form'=>$form->createView()
        ));
    }
}
