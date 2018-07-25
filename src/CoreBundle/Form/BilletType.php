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
use Symfony\Component\Form\Extension\Core\Type\CountryType;
class BilletType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('nom', TextType::class, array(
            'attr' => ['class' => 'form-control'],
            'label' => "Nom",
          ))
          ->add('prenom', TextType::class, array(
            'attr' => ['class' => 'form-control'],
            'label' => "Prénom",         
          ))
          ->add('country', CountryType::class, array(
            'attr' => ['class' => 'form-control'],
            'label' => "Pays de résidence",            
          ))
          ->add('dateNaissance', DateType::class, array(
            'attr' => ['class' => 'form-control js-datepicker', 'format' => 'dd/MM/yyyy'],
            'label' => "Date de naissance",   
            'widget' => 'single_text'
          ))
          ->add('typeBillet', ChoiceType::class, array(
            'choices' => array('Normal' => '0', 'Réduit*' => '1'),
            'expanded' => true,
            'label' => "Type de billet",   
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
