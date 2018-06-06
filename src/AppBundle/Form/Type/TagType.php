<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 14/03/2018
 * Time: 11:55
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType {
    /** * {@inheritdoc} */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', null, array('label' => "Nom", 'attr' => array('class' => 'form-control')))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tag',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getNom()
    {
        return 'tag';
    }
}