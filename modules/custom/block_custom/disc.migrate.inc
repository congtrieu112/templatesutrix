<?php

use Drupal\node\Entity\Node;

function disc_migrate($type, $options = array(), &$context) {



  if (empty($context['sandbox'])) {
    $context['sandbox']['progress'] = 0;
    $context['sandbox']['max'] = $options['number'];
  }
  $end = $context['sandbox']['progress'] + 10;
  if ($context['sandbox']['progress'] < $context['sandbox']['max']) {
    // insert Batch_Test
//            create_node($context['sandbox']['progress'],$options['type']);
    dataexcel_create_excel($context['sandbox']['progress'], $end, $options['type']);
    $context['sandbox']['progress'] ++; // Used to keep track of how many nodes we've already created.
    $context['message'] = "Created node " . $context ['sandbox']['progress'] . " of " . $context['sandbox']['max'];
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
    $_SESSION['seccess_export'] = True;
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
  require_once "modules/custom/PHPExcel/PHPExcel.php";

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
  $name = RandomString() . ".xlsx";
  $linkfile = geturl_curent() . "/" . $name;
  if (isset($_SESSION['linkfile'])) {
    $linkfile = $_SESSION['linkfile'];
  }
  $objWriter->save($linkfile);
  $_SESSION['name'] = $name;
  $_SESSION['linkfile'] = $linkfile;
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
function dowload_file() {

   $url = drupal_get_path('module', 'block_custom').$_SESSION['name'];
    echo '<script type="text/javascript">   setTimeout(function() { window.location.href = "' . $url . '"; }, 2000); </script>';
}