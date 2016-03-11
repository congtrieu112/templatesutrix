<?php

/**
 * @file
 * Contains \Drupal\block_custom\Form\Contactus.
 */

namespace Drupal\block_custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class Contactus.
 *
 * @package Drupal\block_custom\Form
 */
class Contactus extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contactus';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['select_location'] = array(
        '#type' => 'select',
        '#title' => $this->t('select location'),
        '#description' => $this->t('select list'),
        '#options' => array('hongkong' => $this->t('SUTRIX GROUP - HONGKONG')),
    );
    $form['name'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('name'),
        '#description' => $this->t('input name'),
    '#required' => TRUE,

    );
    $form['email'] = array(
        '#type' => 'email',
        '#title' => $this->t('email'),
        '#description' => $this->t('input mail'),
    '#required' => TRUE,

    );
    $form['meseage'] = array(
        '#type' => 'textarea',
        '#title' => $this->t('meseage'),
        '#description' => $this->t('input mesegage'),
    '#required' => TRUE,
    );

    $form['token'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('token'),
    '#required' => TRUE,

    );
    $form['sent'] = array(
        '#type' => 'submit',
        '#title' => $this->t('sent'),
        '#default_value' => $this->t('sent'),
    );


    return  $form;
  
  }
  
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $a = 234;
     $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setPropertyConstraints('value', array('Length' => array('max' => 32)));
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
  }

}
