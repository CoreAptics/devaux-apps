<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SatisfactionController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $listQuestions = $em->getRepository('CoreBundle:Question')->findAll();
        return $this->render('@Front/Default/satisfaction.html.twig', array(
            'listQuestions'=>$listQuestions
        ));
    }
}
