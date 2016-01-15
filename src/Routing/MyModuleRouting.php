<?php

namespace Drupal\mymodule\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class MyModuleRouting extends RouteSubscriberBase
{
  public function alterRoutes(RouteCollection $collection) {
    $route = $collection->get('system.themes_page');
    $route->setDefault('_title', 'Whatever I want');
  }
}