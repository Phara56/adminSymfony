<?php


namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Entity\Chambre;
use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', EntityType::class, array(
            'class' => User::class,
            ))
            ->add('chambre', EntityType::class, array(
                'class' => Chambre::class,
            ))
            ->add('dateArrive',DateType::class, array('label' => "date arrivée", 'attr' => array('class' => 'form-control')))
            ->add('dateDepart',DateType::class, array('label' => "date de départ", 'attr' => array('class' => 'form-control')));
    }
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Reservation',
            'csrf_protection' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getNom()
    {
        return 'reservation';
    }
}