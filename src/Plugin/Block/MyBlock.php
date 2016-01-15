<?php

namespace Drupal\mymodule\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Annotation\Translation;

/**
 * Provides a sample block.
 *
 * @Block(
 *   id = "mymodule_first_block",
 *   admin_label = @Translation("First block from My Module")
 * )
 */
class MyBlock extends BlockBase {
  public function build() {
    return [
      'introduction' => array(
        '#type' => 'markup',
        '#markup' => '<p>' . t('General information goes here.') . '</p>',
      ),
      'colors' => array(
        '#theme' => 'item_list',
        '#items' => array(time(), t('Blue'), t('Green')),
        '#title' => t('Colors'),
      ),
      'materials' => array(
        '#theme' => 'table',
        '#caption' => t('Materials'),
        '#header' => array(t('Material'), t('Characteristic')),
        '#rows' => array(
          array(t('Steel'), t('Strong')),
          array(t('Aluminum'), t('Light')),
        ),
      ),
      '#cache' => [
        'contexts' => [
          'route.name',
        ],
        'tags' => [
          'node:5',
        ],
      ],
    ];
  }
}