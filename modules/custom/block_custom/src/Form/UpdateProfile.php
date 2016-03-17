<?php

/**
 * @file
 * Contains Drupal\block_custom\Form\UpdateProfile.
 */

namespace Drupal\block_custom\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class UpdateProfile.
 *
 * @package Drupal\block_custom\Form
 */
class UpdateProfile extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
        'block_custom.updateprofile',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'update_profile';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('block_custom.updateprofile');
    $email = isset($_SESSION['block_custom']['email']) ? $_SESSION['block_custom']['email'] : "";
    global $base_url;
    $url = $base_url . '/' . Url::fromRoute("block_custom.profile_setting")->getInternalPath();
    $form['email'] = [
        '#type' => 'email',
        '#title' => $this->t('email'),
        '#description' => $this->t('input email'),
        '#default_value' => $email,
        '#required' => TRUE
    ];
    $form['back'] = [
        '#type' => 'button',
        '#attributes' => array('onclick' => 'location.href="' . $url . '";return false;'),
        '#title' => $this->t('Back'),
        '#description' => $this->t('Back'),
        '#default_value' => $this->t('Back'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $user_mail = $form_state->getValue('email');
    if (user_load_by_mail($user_mail)) {
      $form_state->setErrorByName('email', $this->t('Email already exists'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $email = $form_state->getValue('email');
    $_SESSION['block_custom']['email'] = $form_state->getValue('email');
    $user_name = isset($_SESSION['block_custom']['user_name']) ? $_SESSION['block_custom']['user_name'] : "";
    $pass = isset($_SESSION['block_custom']['pass_word']) ? $_SESSION['block_custom']['pass_word'] : "";
    $face = isset($_SESSION['block_custom']['facebook']) ? $_SESSION['block_custom']['facebook'] : "";
    $gmail = isset($_SESSION['block_custom']['google']) ? $_SESSION['block_custom']['google'] : "";
    if (isset($_COOKIE['Drupal_visitor_email'])) {
      user_cookie_delete('email');
    }
    user_cookie_save(array('email' => $email));
    if ($email && $user_name && $pass) {
      $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
      $user = \Drupal\user\Entity\User::create();
//Mandatory settings
      $user->setPassword($pass);
      $user->enforceIsNew();
      $user->setEmail($email);
      $user->setUsername($user_name); //This username must be unique and accept only a-Z,0-9, - _ @ .
//Optional settings
      $user->set("init", 'email');
      $user->set("langcode", $language);
      $user->set("preferred_langcode", $language);
      $user->set("preferred_admin_langcode", $language);
      $user->set("field_facebook", $face);
      $user->set("field_google", $gmail);
      $user->activate();
//Save user
      $res = $user->save();
      $form_state->setRedirect('user.login');
    }
  }

}
