<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class BilletType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('nom', TextType::class, array(
            'attr' => ['class' => 'form-control noLabel']
          ))
          ->add('prenom', TextType::class, array(
            'attr' => ['class' => 'form-control noLabel']         
          ))
          ->add('country', TextType::class, array(
            'attr' => ['class' => 'form-control noLabel']         
          ))
          ->add('dateNaissance', DateType::class)
          ->add('typeBillet', ChoiceType::class, array(
            'choices' => array('Normal' => '0', 'Réduit*' => '1', 'Enfant (-12 ans)' => '2', 'Sénior (+ 65 ans)' => '3'),
            'expanded' => true,
            'multiple' => false,
            'attr' => ['class' => 'form-control']         
          ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoreBundle\Entity\Billet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'corebundle_billet';
    }


}
