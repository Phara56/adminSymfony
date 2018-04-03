<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HotelType extends AbstractType {
    /** * {@inheritdoc} */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', null, array('label' => "Nom", 'attr' => array('class' => 'form-control')))
            ->add('adresse', null, array('label' => "Adresse", 'attr' => array('class' => 'form-control')))
            ->add('nbchambre', null, array('label' => "Nb chambre", 'attr' => array('class' => 'form-control')))
            ->add('tel', null, array('label' => "Téléphone", 'attr' => array('class' => 'form-control')))
            ->add('anneconstruction', null, array('label' => "Année de construction", 'attr' => array('class' => 'form-control')))
            ->add('nbetoile', null, array('label' => "Nb étoile", 'attr' => array('class' => 'form-control')))
            ->add('emailcontact', null, array('label' => "Email de contact", 'attr' => array('class' => 'form-control')))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Hotel',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getNom()
    {
        return 'hotel';
    }
}
