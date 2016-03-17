<?php

/**
 * @file
 * Contains Drupal\block_custom\Form\CreateUserCustom.
 */

namespace Drupal\block_custom\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class CreateUserCustom.
 *
 * @package Drupal\block_custom\Form
 */
class CreateUserCustom extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
        'block_custom.createusercustom',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'create_user_custom';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $user = isset($_SESSION['block_custom']['user_name']) ? $_SESSION['block_custom']['user_name'] : "";
    $pass = isset($_SESSION['block_custom']['pass_word']) ? $_SESSION['block_custom']['pass_word'] : "";
    $form['user_name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('User Name :'),
        '#description' => $this->t('input user name'),
        '#maxlength' => 64,
        '#size' => 64,
        '#default_value' => $user,
        '#required' => TRUE
    ];
    $form['pass_word'] = [
        '#type' => 'password',
        '#title' => $this->t('Pass Word :'),
        '#description' => $this->t('input pass'),
        '#maxlength' => 64,
        '#size' => 64,
        '#default_value' => $pass,
        "#required" => TRUE
    ];
    $form['pass_word_re'] = [
        '#type' => 'password',
        '#title' => $this->t('Re-Pass Word :'),
        '#description' => $this->t('input repass'),
        '#maxlength' => 64,
        '#size' => 64,
        '#default_value' => '',
        "#required" => TRUE
    ];



    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    $user_name = $form_state->getValue('user_name');
    $pass = $form_state->getValue('pass_word');
    $repass = $form_state->getValue('pass_word_re');
    
    
    if (!preg_match("/^[a-z0-9_-]{6,40}$/i", $user_name)) {
      $form_state->setErrorByName('user_name', $this->t('User is not valid'));
    }
    if (!preg_match('/^[a-z0-9_-]{6,40}$/i', $pass)) {
      $form_state->setErrorByName('pass_word', $this->t('Passwords is not valid'));
    }

    if ($pass != $repass) {
      $form_state->setErrorByName('pass_word', $this->t('Passwords do not match'));
    }
    if (user_load_by_name($user_name)) {
      $form_state->setErrorByName('user_name', $this->t('User already exists'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $user_name = $form_state->getValue('user_name');
    $pass = $form_state->getValue('pass_word');
    $_SESSION['block_custom']['user_name'] = $form_state->getValue('user_name');
    $_SESSION['block_custom']['pass_word'] = $form_state->getValue('pass_word');
    $form_state->setRedirect('block_custom.profile_setting');
  }

}
