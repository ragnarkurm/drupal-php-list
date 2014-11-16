<?php

function output($type, $id, $php, $ids, $names) {

  $php = trim($php);
  if (empty($php)) {
    return;
  }

  switch ($type) {
    case 'view':
      $path = "admin/structure/views/view/$id/edit";
      break;
    case 'page':
      $path = "admin/structure/pages/edit/{$id[0]}-{$id[1]}";
      break;
    case 'variant':
      $path = "admin/structure/pages/nojs/operation/{$id[0]}-{$id[1]}/handlers/{$id[2]}/content";
      break;
  }
  $url = url($path, array('absolute' => TRUE));

  $ids = implode(' >> ', $ids);
  $names = implode(' >> ', $names);

  $line = str_repeat('#', 80);

  print <<<TXT
$line
$names
$ids
$url
$line

$php


TXT;

}

