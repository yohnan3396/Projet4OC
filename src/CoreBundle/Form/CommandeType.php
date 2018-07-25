<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CommandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
          ->add('email', EmailType::class)
          ->add('typeCmd', ChoiceType::class, array(
            'choices' => array('Journée' => 'Journée', 'Demi-journée' => 'Demi-journée'),
            'expanded' => true,
            'multiple' => false
          ))
          ->add('dateVisite', DateType::class)
          ->add('billets', CollectionType::class, array(
            'entry_type'   => BilletType::class,
            'allow_add'    => true,
            'allow_delete' => true,
            'attr' => ['class' => 'billetsDiv'],
            'label' => false,
          ))
          ->add('save',      SubmitType::class);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoreBundle\Entity\Commande'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'corebundle_commande';
    }


}
