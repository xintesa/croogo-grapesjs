<?php

namespace Xintesa\Grapesjs\View\Helper;

use Cake\Core\App;
use Cake\Core\Configure;
use Cake\View\Helper;
use Croogo\Core\Router;

/**
 * GrapesjsHelper
 */
class GrapesjsHelper extends Helper
{

    public $helpers = [
        'Html',
        'Js',
    ];

    public function beforeRender($viewFile)
    {
        $actions = array_keys(Configure::read('Wysiwyg.actions'));
        $action = Router::getActionPath($this->getView()->getRequest(), true);
        if (!empty($actions) && in_array($action, $actions)) {
            $this->Html->script('Xintesa/Grapesjs.wysiwyg', ['block' => 'scriptBottom']);
            $this->Html->script([
                'https://grapesjs.com/js/grapes.min.js?v0.15.8',
                'https://grapesjs.com/js/grapesjs-preset-webpage.min.js?v0.1.11',
                'https://grapesjs.com/js/grapesjs-lory-slider.min.js?0.1.5',
                'https://grapesjs.com/js/grapesjs-tabs.min.js?0.1.1',
                'https://grapesjs.com/js/grapesjs-custom-code.min.js?0.1.2',
            ], ['block' => 'scriptBottom']);
            $this->Html->css([
                'https://grapesjs.com/stylesheets/toastr.min.css',
                'https://grapesjs.com/stylesheets/grapes.min.css?v0.15.8',
                'https://grapesjs.com/stylesheets/grapesjs-preset-webpage.min.css',
                'https://grapesjs.com/stylesheets/tooltip.css',
                'https://grapesjs.com/stylesheets/grapesjs-plugin-filestack.css',
            ], ['block' => 'scriptBottom']);

            $ckeditorActions = Configure::read('Wysiwyg.actions');
            if (!isset($ckeditorActions[$action])) {
                return;
            }
            $actionItems = $ckeditorActions[$action];
            $out = null;
            foreach ($actionItems as $actionItem) {
                $element = $actionItem['elements'];
                unset($actionItem['elements']);
                $config = empty($actionItem) ? '{}' : $this->Js->object($actionItem);
                $out .= sprintf('Croogo.Wysiwyg.Grapesjs.setup("%s", %s);', $element, $config);
            }
            $this->Js->buffer($out);
        }
    }
}
