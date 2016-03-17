<?php

/**
 * @file
 * Contains Drupal\block_custom\Form\ProfileSetting.
 */

namespace Drupal\block_custom\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class ProfileSetting.
 *
 * @package Drupal\block_custom\Form
 */
class ProfileSetting extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
        'block_custom.profilesetting',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'profile_setting';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    global $base_url;
    $url = $base_url . '/' . Url::fromRoute("block_custom.create_user_custom")->getInternalPath();
//    $form['avata'] = [
//        '#type' => 'managed_file',
//        '#upload_location' => 'public://',
//        '#title' => $this->t('Avata'),
//        '#description' => $this->t('input avata'),
//        '#default_value' => $avata,
//    ];
    $google = isset($_SESSION['block_custom']['google']) ? $_SESSION['block_custom']['google'] : "";
    $face = isset($_SESSION['block_custom']['facebook']) ? $_SESSION['block_custom']['facebook'] : "";
    $form['facebook'] = [
        '#type' => 'textfield',
        '#title' => $this->t('facebook'),
        '#description' => $this->t('input facebook'),
        '#default_value' => $face,
    ];
    $form['google'] = [
        '#type' => 'textfield',
        '#title' => $this->t('google'),
        '#description' => $this->t('input google'),
        '#default_value' => $google,
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
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $google = $form_state->getValue('google');
    $face = $form_state->getValue('facebook');
    $_SESSION['block_custom']['google'] = $form_state->getValue('google');
    $_SESSION['block_custom']['facebook'] = $form_state->getValue('facebook');
    $form_state->setRedirect('block_custom.update_profile');
  }

}
