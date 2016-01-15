<?php

namespace Drupal\mymodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MyForm.
 */
class MyForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mymodule_myform';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['ajax_output_1'] = [
      '#type' => 'markup',
      '#markup' => '<div id="ajax-output-spot"></div>',
    ];

    $form['text_trigger'] = [
      '#type' => 'textfield',
      '#title' => t('Type here to trigger Ajax'),
      '#prefix' => '<div id="text_trigger_div">',
      '#suffix' => '</div>',
      '#ajax' => [
        'event' => 'keyup',
        'wrapper' => 'text_trigger_div',
        'callback' => 'Drupal\mymodule\Form\MyForm::ajaxTextCallback',
      ],
    ];

    $form['button_trigger'] = [
      '#type' => 'button',
      '#value' => t('Click here to trigger Ajax'),
      '#ajax' => [
        'wrapper' => 'ajax-output-spot',
        'callback' => 'Drupal\mymodule\Form\MyForm::ajaxButtonCallback',
      ],
    ];

    if (!empty($form_state->getValue('text_trigger'))) {
      $form['text_trigger']['#description'] = t("You typed '@value'", array('@value' => $form_state->getValue('text_trigger')));
    }

    return $form;
  }

  /**
   * Ajax data for the text field.
   *
   * @param array $form
   *   The form.
   * @param FormStateInterface $form_state
   *   The form state.
   *
   * @return array
   *   A render array.
   */
  public static function ajaxTextCallback(array $form, FormStateInterface $form_state) {
    return $form['text_trigger'];
  }

  /**
   * Ajax data for the button.
   *
   * @param array $form
   *   The form.
   * @param FormStateInterface $form_state
   *   The form state.
   *
   * @return array
   *   A render array.
   */
  public static function ajaxButtonCallback(array $form, FormStateInterface $form_state) {

    drupal_set_message(t('You have triggered Ajax via a button click'));

    return array(
      '#type' => 'markup',
      '#prefix' => '<div id="ajax-output-spot">',
      '#suffix' => '</div>',
      '#markup' => t('You clicked the button'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }
}
