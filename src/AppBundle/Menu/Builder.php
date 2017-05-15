<?php
/**
 * Created by PhpStorm.
 * User: ramona
 * Date: 28.03.2017
 * Time: 22:57
 */

namespace AppBundle\Menu;


use Knp\Menu\MenuFactory;

class Builder
{
    public function mainMenu(MenuFactory $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Home', ['route'=>'homepage']);
//        $menu->addChild('Lucky', ['route'=>'lucky']);
        $menu->addChild('Offer', ['route' => 'offer']);
        return $menu;
    }
}