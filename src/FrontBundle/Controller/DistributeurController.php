<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DistributeurController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listCountry = $em->getRepository('CoreBundle:Country')->findAll();
        $listCategory = $em->getRepository('CoreBundle:Category')->findAll();
        $listReference = $em->getRepository('CoreBundle:Reference')->findAll();

        return $this->render('@Front/Default/distributeur.html.twig', array(
            'listCountry'=>$listCountry,
            'listCategory'=>$listCategory,
            'listReference'=>$listReference
        ));
    }

    public function ajaxRefreshCountryAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $countryId = $request->get('country');
        $departements = $em->getRepository('CoreBundle:Departement')->findBy(array(
            'country'=>$countryId
        ));
        $villes = $em->getRepository('CoreBundle:Ville')->findBy(array(
            'country'=>$countryId
        ));

        $categories = $em->getRepository('CoreBundle:Category')->findByCountry($countryId);

        $references = $em->getRepository('CoreBundle:Reference')->findByCountry($countryId);
        $json = array();
        if($departements != null){
            $json['departements'] = $this->render('@Front/Default/departements_form.html.twig', array(
                'listDepartement'=>$departements
            ))->getContent();
        }

        $json['villes'] = $this->render('@Front/Default/villes_form.html.twig', array(
            'listVille'=>$villes
        ))->getContent();

        $json['reference'] = $this->render('@Front/Default/reference_form.html.twig', array(
            'listReference'=>$references
        ))->getContent();
        if($categories != null){
            $json['category'] = $this->render('@Front/Default/category_form.html.twig', array(
                'listCategory'=>$categories
            ))->getContent();
        }

        return new Response(json_encode($json));
    }

    public function ajaxRefreshDepartementAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $departementId = $request->get('departement');

        $villes = $em->getRepository('CoreBundle:Ville')->findBy(array(
            'departement'=>$departementId
        ));

        $categories = $em->getRepository('CoreBundle:Category')->findByDepartement($departementId);
        $references = $em->getRepository('CoreBundle:Reference')->findByDEpartement($departementId);
        $json = array();

        $json['villes'] = $this->render('@Front/Default/villes_form.html.twig', array(
            'listVille'=>$villes
        ))->getContent();

        $json['reference'] = $this->render('@Front/Default/reference_form.html.twig', array(
            'listReference'=>$references
        ))->getContent();
        if($categories != null){
            $json['category'] = $this->render('@Front/Default/category_form.html.twig', array(
                'listCategory'=>$categories
            ))->getContent();
        }

        return new Response(json_encode($json));
    }

    public function ajaxRefreshVilleAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $villeId = $request->get('ville');


        $categories = $em->getRepository('CoreBundle:Category')->findByVille($villeId);
        $references = $em->getRepository('CoreBundle:Reference')->findByVille($villeId);

        $json = array();

        $json['reference'] = $this->render('@Front/Default/reference_form.html.twig', array(
            'listReference'=>$references
        ))->getContent();
        if($categories != null){
            $json['category'] = $this->render('@Front/Default/category_form.html.twig', array(
                'listCategory'=>$categories
            ))->getContent();
        }

        return new Response(json_encode($json));
    }

}
