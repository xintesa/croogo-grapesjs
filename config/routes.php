<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin('Xintesa/Grapesjs', ['path' => '/'], function ($routes) {
    $routes->fallbacks(DashedRoute::class);
});
