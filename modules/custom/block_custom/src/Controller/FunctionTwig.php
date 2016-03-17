<?php

/**
 * @file
 * Contains \Drupal\block_custom\Controller\FunctionTwig.
 */

namespace Drupal\block_custom\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class FunctionTwig.
 *
 * @package Drupal\block_custom\Controller
 */
class FunctionTwig extends ControllerBase {
  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello($name) {
    $a = \Drupal::service('twig')->getFilters();
    $b= \Drupal::service('twig')->getFunctions();
    return [
        '#type' => 'markup',
        '#markup' => $this->t("Implement method: hello with parameter(s): $name")
    ];
  }

}
