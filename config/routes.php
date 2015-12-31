<?php

use Cake\Routing\Router;

Router::prefix('admin', function ($routes) {
  $routes->plugin('AkkaFeedback', function ($routes) {
    $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);
    $routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);
  });
});

Router::plugin(
        'AkkaFeedback', ['path' => '/akka-feedback'], function ($routes) {
  $routes->fallbacks('DashedRoute');
}
);
