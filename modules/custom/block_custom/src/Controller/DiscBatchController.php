<?php

/**
 * @file
 * Contains \Drupal\block_custom\Controller\DiscBatchController.
 */

namespace Drupal\block_custom\Controller;

class DiscBatchController {
  public function content() {

    $batch = array(
      'title' => t('Exporting'),
      'operations' => array(
        array('disc_migrate', array('courses', array('foo' => 'bar'))),
      ),
      'finished' => 'disc_migrate_finished_callback',
      'file' => drupal_get_path('module', 'block_custom') . '/disc.migrate.inc',
    );

    batch_set($batch);
    return batch_process('user');
  }
}
