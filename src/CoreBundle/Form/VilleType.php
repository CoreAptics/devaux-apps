<?php

namespace CoreBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VilleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', EntityType::class, array(
                'class'=>'CoreBundle\Entity\Country',
                'choice_label'=>'name',
                'multiple'=>false,
                'label'=>'Pays'
            ))
            ->add('departement', EntityType::class, array(
                'class'=>'CoreBundle\Entity\Departement',
                'choice_label'=>'name',
                'multiple'=>false,
                'label'=>'Département',
                'required'=>false,
                'placeholder'=>'Sélectionner un département'
            ))
            ->add('name', TextType::class, array(
                'label'=>'Nom'
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
            'data_class' => 'CoreBundle\Entity\Ville'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'corebundle_ville';
    }


}
