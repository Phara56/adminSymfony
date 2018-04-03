<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 14/03/2018
 * Time: 11:55
 */

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OutilType extends AbstractType {
    /** * {@inheritdoc} */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', null, array('label' => "Nom", 'attr' => array('class' => 'form-control')))
            ->add('description', null, array('label' => "Description", 'attr' => array('class' => 'form-control')))
            ->add('descriptionPlus', TextareaType::class, array('label' => "Description détaillé", 'attr' => array('class' => 'form-control')))
            ->add('lien', null, array('label' => "Lien", 'attr' => array('class' => 'form-control')))
            ->add('tags', EntityType::class, array(
                'class' => 'AppBundle:Tag',
                'label' => 'Tag',
                'mapped' => false,
                'empty_data' => true,
                'attr' => array('class' => 'custom-select')))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Outil',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getNom()
    {
        return 'outil';
    }
}