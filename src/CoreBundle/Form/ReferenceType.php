<?php

namespace CoreBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReferenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, array(
                'class'=>'CoreBundle\Entity\Category',
                'choice_label'=>'name',
                'multiple'=>false,
                'attr'=>array('class'=>'select2'),
                'label'=>'Catégorie'
            ))
            ->add('ville', EntityType::class, array(
                'class'=>'CoreBundle\Entity\Ville',
                'choice_label'=>'name',
                'multiple'=>false,
                'attr'=>array('class'=>'select2'),
                'label'=>'Ville'
            ))
            ->add('name', TextType::class, array(
                'label'=>'Nom'
            ))
            ->add('address', TextType::class, array(
                'label'=>'Adresse'
            ))
            ->add('zipcode', TextType::class, array(
                'label'=>'Code Postal'
            ))
            ->add('latitude', TextType::class, array(
                'label'=>'Latitude'
            ))
            ->add('longitude', TextType::class, array(
                'label'=>'Longitude'
            ))
            ->add('webSite', TextType::class, array(
                'label'=>'Website ULR'
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
            'data_class' => 'CoreBundle\Entity\Reference'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'corebundle_reference';
    }


}
