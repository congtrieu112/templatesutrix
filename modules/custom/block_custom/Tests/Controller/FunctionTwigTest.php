<?php

/**
 * @file
 * Contains \Drupal\block_custom\Tests\FunctionTwig.
 */

namespace Drupal\block_custom\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the block_custom module.
 */
class FunctionTwigTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "block_custom FunctionTwig's controller functionality",
      'description' => 'Test Unit for module block_custom and controller FunctionTwig.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests block_custom functionality.
   */
  public function testFunctionTwig() {
    // Check that the basic functions of module block_custom.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }

}
