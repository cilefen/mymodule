<?php

namespace Drupal\mymodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MyOtherForm extends FormBase {

  private $colors = [
    'warm' => [
      'red' => 'Red',
      'orange' => 'Orange',
      'yellow' => 'Yellow',
    ],
    'cool' => [
      'blue' => 'Blue',
      'purple' => 'Purple',
      'green' => 'Green',
    ],
  ];

  /**
   * Build the simple form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['temperature'] = [
      '#title' => $this->t('Temperature'),
      '#type' => 'select',
      '#options' => [ 'warm' => 'Warm', 'cool' => 'Cool'],
      '#empty_option' => $this->t('-select'),
      '#ajax' => [
        // Could also use [ $this, 'colorCallback']
        'callback' => '::colorCallback',
        'wrapper' => 'color-wrapper',
      ]
    ];
    $form_state->setCached(FALSE);

    $form['actions'] =[
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    );

    if ($temperature = $form_state->getValue('temperature')) {
      //$form_state->setRebuild();
      $form['color_wrapper'] = [
        '#prefix' => '<div id="color-wrapper">',
        '#suffix' => '</div>',
        '#type' => 'select',
        '#title' => $this->t('Color'),
        '#options' => $this->colors[$temperature],
      ];
    }
    else {
      $form['color_wrapper'] = [
        '#type' => 'container',
        '#attributes' => ['id' => 'color-wrapper'],
      ];
    }

    return $form;
  }

  /**
   * Getter method for Form ID.
   *
   * @inheritdoc
   */
  public function getFormId() {
    return 'fapi_example_ajax_demo';
  }

  /**
   * Callback for Ajax event on color selection.
   */
  public function colorCallback(array &$form, FormStateInterface $form_state) {
    //$form_state->setRebuild();
    return $form['color_wrapper'];
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
   print_r($form_state->getValues());exit();
  }
}
