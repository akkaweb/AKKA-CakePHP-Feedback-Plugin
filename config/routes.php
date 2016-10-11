<?php

use Cake\Routing\Router;

Router::prefix('admin', function ($routes)
{
    $routes->connect('/feedbacks', ['plugin' => 'AkkaFeedback', 'controller' => 'Feedbacks', 'action' => 'index'], ['routeClass' => 'DashedRoute']);
    $routes->connect('/feedbacks/:action/*', ['plugin' => 'AkkaFeedback', 'controller' => 'Feedbacks'], ['routeClass' => 'DashedRoute']);

    $routes->plugin('AkkaFeedback', function ($routes)
    {
        $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);
        $routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);
    });
});

Router::plugin(
    'AkkaFeedback', ['path' => '/akka-feedback'], function ($routes)
{
    $routes->fallbacks('DashedRoute');
}
);
