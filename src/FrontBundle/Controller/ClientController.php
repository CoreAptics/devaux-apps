<?php

namespace FrontBundle\Controller;

use CoreBundle\Entity\Client;
use CoreBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $client->setConnaissance($request->get('civi'));
            if($request->get('autre_text') != null){
                $client->setAutreTexte($request->get('autre_text'));
            }
            $em->persist($client);
            $em->flush();
            return $this->redirectToRoute('front_homepage');
        }

        return $this->render('@Front/Default/form_client.html.twig', array(
            'form'=>$form->createView()
        ));
    }
}
