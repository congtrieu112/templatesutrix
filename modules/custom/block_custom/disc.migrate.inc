<?php
use Drupal\node\Entity\Node;
/**
 * @param $type
 * @param array $options
 * @param $context
 */
function disc_migrate($type, $options = array(), &$context) {
    $display = 10;
  if (empty($context['sandbox'])) {
    $total = ceil($options['number'] / $display);
    $context['sandbox']['progress'] = 0;
      $context['sandbox']['max'] = $options['number'];
      if($options['option'] ==2){
          $context['sandbox']['max'] = $total;
      }
  }
    $curent = $context['sandbox']['progress'] * $display ;
    $start = ($context['sandbox']['progress']==0) ? 0 :  $curent;
  if ($context['sandbox']['progress'] < $context['sandbox']['max']) {
    // insert Batch_Test
      if($options['option'] ==1 ){
          create_node($context['sandbox']['progress'],$options['type']);
          $_SESSION['dowload'] = 0;
          $process = $context ['sandbox']['progress'];
      }else{
          if($options['number'] % $display !=0 && ($context['sandbox']['progress']+1) ==  $context['sandbox']['max'] ){
              $end = $options['number'] % $display;
             if(dataexcel_create_excel($start,$end , $options['type']) == NULL) {
                 $context['sandbox']['progress'] =  $context['sandbox']['max']-1;
             }
          }else{
              if(dataexcel_create_excel($start, $display, $options['type']) == NULL) {
                  $context['sandbox']['progress'] =  $context['sandbox']['max']-1;
              }
          }
          $_SESSION['dowload'] = 1;
          $process = $context ['sandbox']['progress'] * $display;
      }
    $context['sandbox']['progress'] ++; // Used to keep track of how many nodes we've already created.
    $context['message'] = "Created node " . $process . " of " . $options['number'];
  }
  // Check if the batch is finished
  if ($context['sandbox']['progress'] < $context['sandbox'] ['max']) {
    $context['finished'] = $context['sandbox']['progress'] / $context['sandbox']['max'];
    $context['results']['failed_rows'][] = $context['finished'];
  }
}
function disc_migrate_finished_callback($success, $results, $operations) {
  // The 'success' parameter means no fatal PHP errors were detected. All
  // other error management should be handled using 'results'.
  if ($success) {
    $_SESSION['seccess_export'] = $_SESSION['dowload'];
    $message = \Drupal::translation()->formatPlural(
            count($results), 'One post processed.', '@count posts processed.'
    );
  }
  else {
    $message = t('Finished with an error.');
  }
  drupal_set_message($message);
  //$_SESSION['disc_migrate_batch_results'] = $results;
}
function create_node($number, $type) {
  $node = Node::create(array(
              'type' => $type,
              'title' => 'your title ' . $number,
              'langcode' => 'en',
              'uid' => '1',
              'status' => 1,
              'field_fields' => array(),
  ));
  $node->save();
}
function dataexcel_create_excel($start, $end, $type) {
  //include PHPExcel library
  require_once "modules/custom/block_custom/PHPExcel/PHPExcel.php";
//load Excel template file
  $template = str_replace('.inc', '.xlsx', __FILE__);
  if (isset($_SESSION['linkfile'])) {
    $template = $_SESSION['linkfile'];
  }
  $objTpl = PHPExcel_IOFactory::load($template);
  $objTpl->setActiveSheetIndex(0);  //set first sheet as active
//get all data of table
  $datas = getnumbertype($start, $end, $type);
  $count = 0;
  // fields of table
  $fields = array(
      '0' => 'vid',
      '1' => 'body_value',
  );
  $count = $start;
  foreach ($datas as $data) {
    $col = 0;
    foreach ($fields as $field) {
      $var = $count - 2;
      if ($count == 0) {
        $var = 0;
      }
      $str = $data[$field];
      if ($count == 0) {
        $count = $count + 2;
      }
      $objTpl->getActiveSheet()
             ->setCellValueByColumnAndRow($col, $count, $str);
      $col++;
    }
    $count++;
  }
  // Save Excel 2007 file
  $objWriter = new PHPExcel_Writer_Excel2007($objTpl);
//    $objWriter->save(str_replace('.module', '.xlsx', __FILE__));
    $path = getcwd().'/sites/default/files/export';
    if (!file_exists($path)) {
        mkdir($path);
    }
  $linkfile = $path . "/" . RandomString() . ".xlsx";
  if (isset($_SESSION['linkfile'])) {
    $linkfile = $_SESSION['linkfile'];
  }
  $objWriter->save($linkfile);
  $_SESSION['linkfile'] = $linkfile;
    return $datas;
}
function RandomString($number = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randstring = '';
  for ($i = 0; $i < $number; $i++) {
    $randstring[] = $characters[rand(0, strlen($characters))];
  }
  return implode('', $randstring);
}
function geturl_curent() {
  $file = __FILE__;
  $file = explode('/', $file);
  array_pop($file);
  $file = implode('/', $file);
  return $file;
}
function getnumbertype($start, $end, $type) {
  $storage = \Drupal::entityManager()->getStorage('node');
  $nids = $storage->getQuery()
          ->condition('type', $type)
          ->condition('status', 1)
          ->range($start, $end)
          ->execute();
  $home_slides = $storage->loadMultiple($nids);
  if ($home_slides) {
    $i = 0;
    foreach ($home_slides as $key => $value) {
      $array[$i] = array(
          'vid' => $value->vid->value,
          'body_value' => $value->title->value,
      );
      $i++;
    }
    return $array;
  }
  return NULL;
}