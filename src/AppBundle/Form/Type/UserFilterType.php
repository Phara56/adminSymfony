<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 14/03/2018
 * Time: 12:01
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class UserFilterType extends AbstractType {
    /** * {@inheritdoc} */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', 'filter_text', array('label' => "Nom d'utilisateur"))
            ->add('email', 'filter_text', array('label' => 'E-mail'))
            ->add('enabled', 'filter_boolean', array('label' => 'Autorisé'))
            ->add('groups', 'filter_entity', array(
                'label' => 'Groupes',
                'class' => 'AppBundle\Entity\Group',
                'expanded' => true,
                'multiple' => true,
                'apply_filter' => function (QueryInterface $filterQuery, $field, $values) {
                    $query = $filterQuery->getQueryBuilder();
                    $query->leftJoin($field, 'm');
                    // Filter results using orWhere matching ID
                    foreach ($values['value'] as $value) {
                        $query->orWhere($query->expr()->in('m.id', $value->getId()));
                    }
                },
            ))
        ;
}

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
            'csrf_protection' => false,
            'validation_groups' => array('filter'),
            'method' => 'GET',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'user_filter';
    }
}