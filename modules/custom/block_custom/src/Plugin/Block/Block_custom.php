<?php

/**
 * @file
 * Contains \Drupal\block_custom\Plugin\Block\Block_custom.
 */

namespace Drupal\block_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
/**
 * Provides a 'Block_custom' block.
 *
 * @Block(
 *  id = "block_custom",
 *  admin_label = @Translation("Block custom"),
 * )
 */
class Block_custom extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function build() {
    $storage = \Drupal::entityManager()->getStorage('node');
    $nids = $storage->getQuery()
        ->condition('type', 'slide_home')
        ->condition('status', 1)
        ->execute();
    $home_slides =  $storage->loadMultiple($nids);
    foreach ($home_slides as $key => $value) {
      $field_properties = array_keys($value
                        ->getFieldDefinition('field_banner')
                        ->getFieldStorageDefinition()
                        ->getPropertyDefinitions());
      $body_value =  $value->body->value;
      $field_discorver_url = $value->field_discorver->uri;
      $field_discorver_title = $value->field_discorver->title;
      $field_location = $value->field_location->value;
      $fid = $value->field_banner->target_id;
      $file = File::load($fid);
      $banner = $file->getFileUri();
      $url = file_create_url($banner);
      $home_slide[$key] = ['title'=>$value->getTitle(),'body'=>$body_value,'field_discorver'=>['link'=> parse_url($field_discorver_url)['path'] ,'title'=>$field_discorver_title],'field_location'=>$field_location,'banner'=>$url];
    }
    $build = [];
    $build['block_custom']['#markup'] = $home_slide;

    return $build;
  }

}
