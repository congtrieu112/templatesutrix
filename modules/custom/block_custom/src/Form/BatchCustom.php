<?php
/**
 * @file
 * Contains Drupal\block_custom\Form\BatchCustom.
 */
namespace Drupal\block_custom\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Class BatchCustom.
 *
 * @package Drupal\block_custom\Form
 */
class BatchCustom extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
        'block_custom.batchcustom',
    ];
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'batch_custom';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('block_custom.batchcustom');
    $array = [];
    $all_type = node_type_get_types();
    foreach ($all_type as $key => $value) {
      $array[$key] = $value->toArray()['name'];
    }
    $form['content_type'] = [
        '#type' => 'select',
       '#title' => t('Selected content type'),
       '#options' => $array,
       '#default_value' => "",
       '#description' => t('Set this to <em>Yes</em> if you would like this category to be selected by default.'),
    ];
    $form['number_recore'] = [
        '#type' => 'number',
        '#title' => $this->t('number recore'),
        '#description' => $this->t('input number recore'),
        '#default_value' => "",
    ];
      $form['select_option'] = [
          '#type' => 'select',
          '#title' => t('Selected option'),
          '#options' => array(1=>'import data',2=>'export data'),
          '#default_value' => "",
          '#description' => t('Set this to <em>Yes</em> if you would like this category to be selected by default.'),
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
//    parent::submitForm($form, $form_state);
//    $this->config('block_custom.batchcustom')
//      ->set('content_type', $form_state->getValue('content_type'))
//      ->set('number_recore', $form_state->getValue('number_recore'))
//      ->save();
    $batch = array(
      'title' => $this->t('Exporting'),
      'operations' => array(
        array('disc_migrate', array('courses', array('type'=>$form_state->getValue('content_type'),'number' => $form_state->getValue('number_recore'),'option'=>$form_state->getValue('select_option')))),
      ),
      'finished' => 'disc_migrate_finished_callback',
      'file' => drupal_get_path('module', 'block_custom') . '/disc.migrate.inc',
    );
    batch_set($batch);
//    return batch_process('user');
  }
}