<?php

namespace BackBundle\Controller;

use CoreBundle\Entity\Groups;
use CoreBundle\Form\GroupsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groups = $em->getRepository('CoreBundle:Groups')->findAll();

        return $this->render('@Back/Groups/list.html.twig',array(
            'listGroups'=>$groups
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $groups = new Groups();
        $form = $this->createForm(GroupsType::class, $groups);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($groups);
            $em->flush();

            return $this->redirectToRoute('back_group_list');
        }
        return $this->render('@Back/Groups/add.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $groups = $em->getRepository('CoreBundle:Groups')->find($id);
        $form = $this->createForm(GroupsType::class, $groups);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->flush();

            return $this->redirectToRoute('back_group_list');
        }
        return $this->render('@Back/Groups/add.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $groups = $em->getRepository('CoreBundle:Groups')->find($id);

        $em->remove($groups);
        $em->flush();
        return $this->redirectToRoute('back_group_list');
    }
}
