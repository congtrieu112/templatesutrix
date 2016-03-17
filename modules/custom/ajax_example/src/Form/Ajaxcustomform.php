<?php

/**
 * @file
 * Contains \Drupal\ajax_example\Form\Ajaxcustomform.
 */

namespace Drupal\ajax_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class Ajaxcustomform.
 *
 * @package Drupal\ajax_example\Form
 */
class Ajaxcustomform extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ajaxcustomform';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['test'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('test'),
      '#description' => $this->t('sdf'),
      '#maxlength' => 64,
      '#size' => 64,
    );
    $form['sdf'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('sdf'),
      '#description' => $this->t('sd'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
