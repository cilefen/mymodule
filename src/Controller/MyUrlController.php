<?php

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MyUrlController extends ControllerBase {

  // Database service, obtained through dependency injection.
  // This is needed for the pager sample output in a later section.
  protected $database;

  public static function create(ContainerInterface $container) {
    return new static($container->get('database'));
  }

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  // Page-generating method.
  public function generateMyPage($id) {
    $render = [
      'foo' => [
        '#theme' => 'item_list',
        '#items' => ['a', $id],
      ],
    ];
    return $render;
  }
}