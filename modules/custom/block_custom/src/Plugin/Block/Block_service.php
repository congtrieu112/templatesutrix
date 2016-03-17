<?php

/**
 * @file
 * Contains \Drupal\block_custom\Plugin\Block\Block_service.
 */

namespace Drupal\block_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Block_service' block.
 *
 * @Block(
 *  id = "block_service",
 *  admin_label = @Translation("Block service"),
 * )
 */
class Block_service extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form['service'] = array(
        '#type' => 'details',
        '#title' => t('About service'),
        '#group' => 'additional_settings',
    );

    $form['service']['title'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('title'),
        '#description' => $this->t('input title'),
        '#default_value' => isset($this->configuration['title']) ? $this->configuration['title'] : '',
        '#maxlength' => 64,
        '#size' => 64,
    );
    $form['service']['info'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('info'),
        '#format' => 'full_html',
        '#description' => $this->t('info content'),
        '#default_value' => isset($this->configuration['infos']) ? $this->configuration['infos'] : '',
    );

    $form['service']['icon_one'] = array(
        '#type' => 'details',
        '#title' => $this->t('About service icon one'),
        '#group' => 'additional_settings',
    );
    $form['service']['icon_one']['class_icon_one'] = array(
        "#type" => "textfield",
        "#title" => $this->t("class icon"),
        "#description" => $this->t("input class icon"),
        "#default_value" => isset($this->configuration['class_icon_one']) ? $this->configuration['class_icon_one'] : '',
    );
    $form['service']['icon_one']['links'] = array(
        '#type' => 'details',
        '#title' => $this->t('About service'),
        '#group' => 'additional_settings',
    );

    $form['service']['icon_one']['links']['title_icon_one_link'] = array(
        "#type" => "textfield",
        "#title" => $this->t("title"),
        "#description" => $this->t("input title"),
        "#default_value" => isset($this->configuration['title_icon_one_link']) ? $this->configuration['title_icon_one_link'] : '',
    );
    $form['service']['icon_one']['links']['url_icon_one_link'] = array(
        "#type" => "textfield",
        "#title" => $this->t("link"),
        "#description" => $this->t("input link"),
        "#default_value" => isset($this->configuration['url_icon_one_link']) ? $this->configuration['url_icon_one_link'] : '',
    );


    for ($i = 0; $i < 5; $i++) {
      $form['service']['icon_one']["icon_sub_$i"] = array(
          '#type' => 'details',
          '#title' => $this->t("icon sub $i"),
          '#group' => 'additional_settings',
      );
      $form['service']['icon_one']["icon_sub_$i"]["sub_icon_one_title_$i"] = array(
          "#type" => "textfield",
          "#title" => $this->t("title name"),
          "#description" => $this->t("input title name"),
          "#default_value" => isset($this->configuration["sub_icon_one_title_$i"]) ? $this->configuration["sub_icon_one_title_$i"] : '',
      );
      $form['service']['icon_one']["icon_sub_$i"]["sub_icon_one_$i"] = array(
          "#type" => "textfield",
          "#title" => $this->t("class name"),
          "#description" => $this->t("input class name"),
          "#default_value" => isset($this->configuration["sub_icon_one_$i"]) ? $this->configuration["sub_icon_one_$i"] : '',
      );
      $form['service']['icon_one']["icon_sub_$i"] ["sub_icon_one_info_$i"] = array(
          "#type" => "text_format",
          "#format" => "full_html",
          "#title" => $this->t("info "),
          "#description" => $this->t("input info"),
          "#default_value" => isset($this->configuration["sub_icon_one_info_$i"]) ? $this->configuration["sub_icon_one_info_$i"] : '',
      );
    }


//    
    $form['service']['icon_two'] = array(
        '#type' => 'details',
        '#title' => $this->t('About service icon two'),
        '#group' => 'additional_settings',
    );
    $form['service']['icon_two']['class_icon_two'] = array(
        "#type" => "textfield",
        "#title" => $this->t("class icon"),
        "#description" => $this->t("input class icon"),
        "#default_value" => isset($this->configuration['class_icon_two']) ? $this->configuration['class_icon_two'] : '',
    );
    $form['service']['icon_two']['links'] = array(
        '#type' => 'details',
        '#title' => $this->t('About service'),
        '#group' => 'additional_settings',
    );

    $form['service']['icon_two']['links']['title_icon_two_link'] = array(
        "#type" => "textfield",
        "#title" => $this->t("title"),
        "#description" => $this->t("input title"),
        "#default_value" => isset($this->configuration['title_icon_two_link']) ? $this->configuration['title_icon_two_link'] : '',
    );
    $form['service']['icon_two']['links']['url_icon_two_link'] = array(
        "#type" => "textfield",
        "#title" => $this->t("link"),
        "#description" => $this->t("input link"),
        "#default_value" => isset($this->configuration['url_icon_two_link']) ? $this->configuration['url_icon_two_link'] : '',
    );


    for ($i = 0; $i < 5; $i++) {
      $form['service']['icon_two']["icon_sub_$i"] = array(
          '#type' => 'details',
          '#title' => $this->t("icon sub $i"),
          '#group' => 'additional_settings',
      );
      $form['service']['icon_two']["icon_sub_$i"] ["sub_icon_two_title_$i"] = array(
          "#type" => "textfield",
          "#title" => $this->t("title"),
          "#description" => $this->t("input title name"),
          "#default_value" => isset($this->configuration["sub_icon_two_title_$i"]) ? $this->configuration["sub_icon_two_title_$i"] : '',
      );
      $form['service']['icon_two']["icon_sub_$i"] ["sub_icon_two_$i"] = array(
          "#type" => "textfield",
          "#title" => $this->t("class name"),
          "#description" => $this->t("input class name"),
          "#default_value" => isset($this->configuration["sub_icon_two_$i"]) ? $this->configuration["sub_icon_two_$i"] : '',
      );
      $form['service']['icon_two']["icon_sub_$i"] ["sub_icon_two_info_$i"] = array(
          "#type" => "text_format",
          "#format" => "full_html",
          "#title" => $this->t("info "),
          "#description" => $this->t("input info"),
          "#default_value" => isset($this->configuration["sub_icon_two_info_$i"]) ? $this->configuration["sub_icon_two_info_$i"] : '',
      );
    }



    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['title'] = $form_state->getValue('service')['title'];
    $this->configuration['infos'] = $form_state->getValue('service')['info']['value'];

    $this->configuration['class_icon_one'] = $form_state->getValue('service')['icon_one']['class_icon_one'];
    $this->configuration['title_icon_one_link'] = $form_state->getValue('service')['icon_one']['links']['title_icon_one_link'];
    $this->configuration['url_icon_one_link'] = $form_state->getValue('service')['icon_one']['links']['url_icon_one_link'];


    $this->configuration['class_icon_two'] = $form_state->getValue('service')['icon_two']['class_icon_two'];
    $this->configuration['title_icon_two_link'] = $form_state->getValue('service')['icon_two']['links']['title_icon_two_link'];
    $this->configuration['url_icon_two_link'] = $form_state->getValue('service')['icon_two']['links']['url_icon_two_link'];

    for ($i = 0; $i < 5; $i++) {
      $this->configuration["sub_icon_one_title_$i"] = $form_state->getValue('service')['icon_one']["icon_sub_$i"]["sub_icon_one_title_$i"];
      $this->configuration["sub_icon_one_$i"] = $form_state->getValue('service')['icon_one']["icon_sub_$i"]["sub_icon_one_$i"];
      $this->configuration["sub_icon_one_info_$i"] = $form_state->getValue('service')['icon_one']["icon_sub_$i"]["sub_icon_one_info_$i"]["value"];

      $this->configuration["sub_icon_two_title_$i"] = $form_state->getValue('service')['icon_two']["icon_sub_$i"]["sub_icon_two_title_$i"];
      $this->configuration["sub_icon_two_$i"] = $form_state->getValue('service')['icon_two']["icon_sub_$i"]["sub_icon_two_$i"];
      $this->configuration["sub_icon_two_info_$i"] = $form_state->getValue('service')['icon_two']["icon_sub_$i"]["sub_icon_two_info_$i"]["value"];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $array = [];
    for ($i = 0; $i < 5; $i++) {
      $array["one"][$i] = array(
          "title" => $this->configuration["sub_icon_one_title_$i"],
          "class" => $this->configuration["sub_icon_one_$i"],
          "info" => $this->configuration["sub_icon_one_info_$i"],
      );
      $array["two"][$i] = array(
          "title" => $this->configuration["sub_icon_two_title_$i"],
          "class" => $this->configuration["sub_icon_two_$i"],
          "info" => $this->configuration["sub_icon_two_info_$i"],
      );
    }
    $content = array(
        'title' => $this->configuration['title'],
        'info' => $this->configuration['infos'],
        'class_icon_one' => $this->configuration["class_icon_one"],
        'title_icon_one_link' => $this->configuration['title_icon_one_link'],
        'url_icon_one_link' => $this->configuration['url_icon_one_link'],
        'class_icon_two' => $this->configuration['class_icon_two'],
        'title_icon_two_link' => $this->configuration['title_icon_two_link'],
        'url_icon_two_link' => $this->configuration['url_icon_two_link'],
        'contents' => $array
    );

    $build['#markup'] = $content;

    return $build;
  }

}
