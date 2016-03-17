<?php

/**
 * @file
 * Contains \Drupal\block_custom\Plugin\Block\Block_about.
 */

namespace Drupal\block_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

/**
 * Provides a 'Block_about' block.
 *
 * @Block(
 *  id = "block_about",
 *  admin_label = @Translation("Block about"),
 * )
 */
class Block_about extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form['home'] = array(
        '#type' => 'details',
        '#title' => t('About Home'),
        '#group' => 'additional_settings',
    );
    $form['home']['title'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('title'),
        '#description' => $this->t('title about'),
        '#default_value' => isset($this->configuration['title']) ? $this->configuration['title'] : '',
        '#maxlength' => 64,
        '#size' => 64,
    );
    $form['home']['info'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('info'),
        '#format' => 'full_html',
        '#description' => $this->t('info content'),
        '#default_value' => isset($this->configuration['infos']) ? $this->configuration['infos'] : '',
    );
    $form['home']['image_info'] = array(
        '#type' => 'managed_file',
        '#title' => $this->t('image info'),
        '#upload_location' => 'public://',
        '#description' => $this->t('input image info'),
        '#default_value' => isset($this->configuration['image_info']) ? $this->configuration['image_info'] : '',
    );

    $form['home']['sub_about_one'] = array(
        '#type' => 'details',
        '#title' => t('Sub About Home One'),
        '#group' => 'additional_settings',
    );
    $form['home']['sub_about_two'] = array(
        '#type' => 'details',
        '#title' => t('Sub About Home Two'),
        '#group' => 'additional_settings',
    );




    $form['home']['sub_about_one']['title_sub_one_about'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('title'),
        '#description' => $this->t('input title'),
        '#default_value' => isset($this->configuration['title_sub_one_about']) ? $this->configuration['title_sub_one_about'] : '',
    );
    $form['home']['sub_about_one']['info_sub_one_about'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('info '),
        '#description' => $this->t('input info'),
        '#format' => 'full_html',
        '#default_value' => isset($this->configuration['info_sub_one_about']) ? $this->configuration['info_sub_one_about'] : '',
    );
    $form['home']['sub_about_one']['links'] = array(
        '#type' => 'details',
        '#title' => t('Sub About Home One link'),
        '#group' => 'additional_settings',
    );

    $form['home']['sub_about_one']['links']['link_link_sub_one_about'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('link '),
        '#description' => $this->t('input link'),
        '#default_value' => isset($this->configuration['link_link_sub_one_about']) ? $this->configuration['link_link_sub_one_about'] : '',
    );
    $form['home']['sub_about_one']['links']['title_link_sub_one_about'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('title '),
        '#description' => $this->t('input title'),
        '#default_value' => isset($this->configuration['title_link_sub_one_about']) ? $this->configuration['title_link_sub_one_about'] : '',
    );



    $form['home']['sub_about_two']['title_sub_two_about'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('title'),
        '#description' => $this->t('input title'),
        '#default_value' => isset($this->configuration['title_sub_two_about']) ? $this->configuration['title_sub_two_about'] : '',
    );
    $form['home']['sub_about_two']['info_sub_two_about'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('info '),
        '#format' => 'full_html',
        '#description' => $this->t('input info'),
        '#default_value' => isset($this->configuration['info_sub_two_about']) ? $this->configuration['info_sub_two_about'] : '',
    );
    $form['home']['sub_about_two']['links'] = array(
        '#type' => 'details',
        '#title' => t('Sub About Home Two Link'),
        '#group' => 'additional_settings',
    );
    $form['home']['sub_about_two']['links']['link_link_sub_two_about'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('link '),
        '#description' => $this->t('input link'),
        '#default_value' => isset($this->configuration['link_link_sub_two_about']) ? $this->configuration['link_link_sub_two_about'] : '',
    );
    $form['home']['sub_about_two']['links']['title_link_sub_two_about'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('title '),
        '#description' => $this->t('input title'),
        '#default_value' => isset($this->configuration['title_link_sub_two_about']) ? $this->configuration['title_link_sub_two_about'] : '',
    );



    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['infos'] = $form_state->getValue('home')['info']['value'];
    $this->configuration['image_info'] = $form_state->getValue('home')['image_info'];
    $this->configuration['title'] = $form_state->getValue('home')['title'];
    $this->configuration['title_sub_one_about'] = $form_state->getValue('home')['sub_about_one']['title_sub_one_about'];
    $this->configuration['info_sub_one_about'] = $form_state->getValue('home')['sub_about_one']['info_sub_one_about']['value'];
    $this->configuration['link_link_sub_one_about'] = $form_state->getValue('home')['sub_about_one']['links']['link_link_sub_one_about'];
    $this->configuration['title_link_sub_one_about'] = $form_state->getValue('home')['sub_about_one']['links']['title_link_sub_one_about'];
    $this->configuration['title_sub_two_about'] = $form_state->getValue('home')['sub_about_two']['title_sub_two_about'];
    $this->configuration['info_sub_two_about'] = $form_state->getValue('home')['sub_about_two']['info_sub_two_about']['value'];
    $this->configuration['link_link_sub_two_about'] = $form_state->getValue('home')['sub_about_two']['links']['link_link_sub_two_about'];
    $this->configuration['title_link_sub_two_about'] = $form_state->getValue('home')['sub_about_two']['links']['title_link_sub_two_about'];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $fid = $this->configuration['image_info'][0];
    $url = $banner = "";
    if ($fid) {
      if ($file = File::load($fid)) {
        $banner = $file->getFileUri();
        $url = file_create_url($banner);
      }
    }

    $content = array(
        'infos' => $this->configuration['infos'],
        'image_info' => $url,
        'title' => $this->configuration['title'],
        'title_sub_one_about' => $this->configuration['title_sub_one_about'],
        'info_sub_one_about' => $this->configuration['info_sub_one_about'],
        'link_link_sub_one_about' => $this->configuration['link_link_sub_one_about'],
        'title_link_sub_one_about' => $this->configuration['title_link_sub_one_about'],
        'title_sub_two_about' => $this->configuration['title_sub_two_about'],
        'info_sub_two_about' => $this->configuration['info_sub_two_about'],
        'link_link_sub_two_about' => $this->configuration['link_link_sub_two_about'],
        'title_link_sub_two_about' => $this->configuration['title_link_sub_two_about'],
    );





    $build['#markup'] = $content;



    return $build;
  }

}
