<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 14/03/2018
 * Time: 12:11
 */

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware {

    public function buildMainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav no-borders');

        $menu->addChild('entities', array(
            'label' => 'Gestion'
        ))
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'fa fa-list');

        $menu['entities']
            ->addChild('users', array(
                'route' => 'admin_users',
                'label' => 'Utilisateurs'));

        $menu['entities']
            ->addChild('groups', array(
                'route' => 'admin_groups',
                'label' => 'Groupes'));

        return $menu;
    }

    public function buildUserMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav no-borders navbar-right');

        $context = $this->container->get('security.context');
        if ($context->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

            $menu->addChild('profile', array(
                'label' => $context->getToken()->getUser()->getUsername()))
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'fa fa-user');

            $menu['profile']->addChild('Se déconnecter', array('route' => 'fos_user_security_logout'))
                ->setAttribute('icon', 'fa fa-unlink');
            $menu['profile']->addChild("Se connecter sous un autre profil", array('route' => 'fos_user_security_login'))
                ->setAttribute('icon', 'fa fa-link');
        }

        return $menu;
    }

}