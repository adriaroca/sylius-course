<?php

namespace App\Listener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class AdminMainMenuListener
{
    public function addSupplier(MenuBuilderEvent $event): void
    {
        $event->getMenu()->getChild('configuration')
            ->addChild('suppliers', ['route' => 'app_admin_supplier_index'])
            ->setLabel('sylius.menu.admin.main.configuration.suppliers')
            ->setLabelAttribute('icon', 'bullhorn');
    }
}
