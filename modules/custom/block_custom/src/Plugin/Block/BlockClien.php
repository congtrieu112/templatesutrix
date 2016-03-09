<?php

/**
 * @file
 * Contains \Drupal\block_custom\Plugin\Block\BlockClien.
 */

namespace Drupal\block_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

/**
 * Provides a 'BlockClien' block.
 *
 * @Block(
 *  id = "block_clien",
 *  admin_label = @Translation("Block clien"),
 * )
 */
class BlockClien extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $storage = \Drupal::entityManager()->getStorage('node');
    $nids = $storage->getQuery()
            ->condition('type', 'client')
            ->condition('status', 1)
            ->execute();
    $entitys = $storage->loadMultiple($nids);
    $content= [];
    foreach ($entitys as $key => $value) {
      $field_properties = array_keys($value
                      ->getFieldDefinition('field_url')
                      ->getFieldStorageDefinition()
                      ->getPropertyDefinitions());
      $field_url_link = $value->field_url->uri;
      $field_url_title = $value->field_url->title;
      $fid = $value->field_logo->target_id;
      $title_logo = $value->field_logo->title;
      $url = $banner = "";
      if ($fid) {
        if ($file = File::load($fid)) {
          $banner = $file->getFileUri();
          $url = file_create_url($banner);
        }
      }
      $content[] = array(
          'image' => $url,
          'link' => $field_url_link,
          'alt' => $field_url_title,
      );
    }
    $build = [];
    $build['#markup'] = $content;

    return $build;
  }

}
