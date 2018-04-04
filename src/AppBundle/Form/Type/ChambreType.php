<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Entity\Hotel;
use AppBundle\Form\Type\HotelType;

class ChambreType extends AbstractType {
    /** * {@inheritdoc} */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', null, array('label' => "Nom", 'attr' => array('class' => 'form-control')))
            ->add('nbmcarre', null, array('label' => "Nombre de M²", 'attr' => array('class' => 'form-control', 'min' => '0')))
            ->add('nbpiece', null, array('label' => "Nombre de pièce", 'attr' => array('class' => 'form-control', 'min' => '0')))
            ->add('nbsdb', null, array('label' => "Nombre de salle de bain", 'attr' => array('class' => 'form-control', 'min' => '0')))
            ->add('nbchambre', null, array('label' => "Nombre de chambre", 'attr' => array('class' => 'form-control', 'min' => '0')))
            ->add('nbpersonne', null, array('label' => "Nombre de personne", 'attr' => array('class' => 'form-control', 'min' => '0')))
            ->add('nblitsolo', null, array('label' => "Nombre de lit 1 place", 'attr' => array('class' => 'form-control', 'min' => '0')))
            ->add('nblitdouble', null, array('label' => "Nombre de 2 places", 'attr' => array('class' => 'form-control', 'min' => '0')))
            ->add('animal', checkboxType::class, array('label' => "Animal", 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('douche', checkboxType::class, array('label' => "Douche", 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('baignoire', checkboxType::class, array('label' => "Baignoire", 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('tv', checkboxType::class, array('label' => "Télévision", 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('wifi', checkboxType::class, array('label' => "Wifi", 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('telephone', checkboxType::class, array('label' => "Téléphone", 'required' => false, 'attr' => array('class' => 'form-control')))
            ->add('hotel', EntityType::class, array(
                'class' => Hotel::class,
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Chambre',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getNom()
    {
        return 'chambre';
    }
}
