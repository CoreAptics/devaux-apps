<?php

namespace BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Form\AdminEditType;
use CoreBundle\Entity\Admin;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdminController extends Controller
{
    public function loginAction(Request $request){
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('BackBundle:Admin:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $admins = $em->getRepository('CoreBundle:Admin')->findAll();

        return $this->render('@Back/admin/list.html.twig', array('list_admins'=>$admins));
    }

    public function editAction(Request $request, Admin $admin, $id)
    {
        $form = $this->createForm(AdminEditType::class, $admin);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('back_admin_list');
        }
        return $this->render('@Back/admin/edit.html.twig', array(
            'form'=>$form->createView(),
            'admin'=>$admin,
        ));
    }

    public function deleteAction(Admin $admin, $id)
    {
        if($this->getUser() == $admin)
            return $this->redirectToRoute('back_admin_list');
        $em = $this->getDoctrine()->getManager();
        $em->remove($admin);
        $em->flush();
        return $this->redirectToRoute('back_admin_list');
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $admin = new Admin();
        $form = $this->createForm(AdminEditType::class, $admin);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $adminToCompare = $em->getRepository('CoreBundle:Admin')->findOneBy(array(
                'email'=>$admin->getEmail()
            ));
            if($adminToCompare === null){
//                Initialisation des variables
                $tokenExpiration = $em->getRepository('CoreBundle:Parameter')->findOneBy(array(
                    'name'=>'tokenExpiration'
                ));
                $dateInSevenDays = new \DateTime();
                $dateInSevenDays->add(new \DateInterval('P'.$tokenExpiration->getValue().'D'));

                $char = 'abcdefghijklmnopqrstuvwxyz';
                $charUp = strtoupper($char);
                $char = $charUp.$char."0123456789";
                $mdp = str_shuffle($char);
                $mdp = substr($mdp, 0, 8);
                $plainPassword = $mdp;
                $plainPassword = $mdp;

//                Encodage du MDP
                $encoder = $this->get('security.password_encoder');
                $encodedPassword = $encoder->encodePassword($admin,$plainPassword);
                $admin->setPassword($encodedPassword);
//                Persistance de l'entité
                $em->persist($admin);
                $em->flush();
//                Création d'une instance de message
                $message = \Swift_Message::newInstance()
                    ->setSubject('Activation de votre compte')
                    ->setFrom($this->getParameter('mailer_user'))
                    ->setTo($admin->getEmail())
                    ->setBody($this->renderView(
                        'Emails/addAdmin.html.twig',
                        array(
                            'password'=>$plainPassword
                        )
                    ),
                        'text/html'
                    );
                $this->get('mailer')->send($message);

                return $this->redirectToRoute('back_admin_edit', array('id'=>$admin->getId()));
            } else {
                return $this->render('@Back/admin/add.html.twig',array(
                    'form'=>$form->createView(),
                    'message'=> 'Email déjà pris',
                ));
            }
        }
        return $this->render('@Back/admin/add.html.twig',array(
            'form'=>$form->createView(),
        ));
    }
}
