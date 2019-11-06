<?php

namespace Xintesa\Grapesjs\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Croogo\Core\Croogo;

/**
 * Grapesjs Event Handler
 */
class GrapesjsEventHandler implements EventListenerInterface
{

    /**
     * implementedEvents
     *
     * @return array
     */
    public function implementedEvents()
    {
        return [
            'Croogo.bootstrapComplete' => [
                'callable' => 'onBootstrapComplete',
            ],
        ];
    }

    /**
     * Hook helper
     */
    public function onBootstrapComplete($event)
    {
        foreach ((array)Configure::read('Wysiwyg.actions') as $action => $settings) {
            $action = base64_decode($action);
            $action = explode('/', $action);
            array_pop($action);
            Croogo::hookHelper(implode('/', $action), 'Xintesa/Grapesjs.Grapesjs');
        }
    }

}
