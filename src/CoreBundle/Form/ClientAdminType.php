<?php

namespace CoreBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientAdminType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'attr'=>array('placeholder'=>'Nom')
            ))
            ->add('prenom', TextType::class, array(
                'attr'=>array('placeholder'=>'Prénom')
            ))
            ->add('email', EmailType::class, array(
                'attr'=>array('placeholder'=>'Email')
            ))
            ->add('adresse', TextType::class, array(
                'attr'=>array('placeholder'=>'Adresse')
            ))
            ->add('ville', TextType::class, array(
                'attr'=>array('placeholder'=>'Ville')
            ))
            ->add('postal', TextType::class, array(
                'attr'=>array('placeholder'=>'Code Postal')
            ))
            ->add('connaissance', ChoiceType::class, array(
                'label'=>'Comment j\'ai connu Devaux ?',
                'choices'=>array(
                    'Bouche-à-oreille'=>'Bouche',
                    'Office de Tourisme'=>'Office',
                    'Internet'=>'Internet',
                    'Autre'=>'Autre'
                )
            ))
            ->add('newsletter', CheckboxType::class, array(
                'required'=>false,
                'label'=>' Je ne souhaite pas m\'abonner à la Newsletter Champagne Devaux',
            ))
            ->add('Valider', SubmitType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoreBundle\Entity\Client'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'corebundle_client';
    }


}
