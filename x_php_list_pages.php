<?php

require_once 'general.inc';

// http://www.patrickjwaters.com/blog/2014-09-23/how-programmatically-load-panel-pages-database-and-include-panel-pages-stored-code-u

// Now check all panel pages and ignore all mini panels
ctools_include('page', 'page_manager', 'plugins/tasks');
ctools_include('page_manager.admin', 'page_manager', '');
ctools_include('export');
 
$tasks = page_manager_get_tasks_by_type('page');
$page_types = array();
 
foreach ($tasks as $task) {
  // Disabled page return empty
  if ($handlers = page_manager_load_task_handlers($task)) {
    $page_types[] = $handlers;
  }
}
// Not all display objects are loaded, make sure to load them
foreach ($page_types as &$handlers) {
  foreach ($handlers as &$handler) {
    if (empty($handler->conf['display']) && !empty($handler->conf['did'])) {
      $handler->conf['display'] = panels_load_display($handler->conf['did']);
    }
  }
}
// Page types will have all panel page objects fully loaded

// get another aspect of pages, to get url path components
// unfortunately no bridge to id-s.
// $manager_pages = array('operations' => array(), 'tasks' => array());
// page_manager_get_pages($tasks, $manager_pages);

// load pages (without variants)
$pages = page_manager_page_load_all();
// print_r($pages);

foreach ($pages as $page_id => &$page) {
  $page_name = $page->admin_title;
  if (
    TRUE
    && !empty($page->access)
    && !empty($page->access['plugins'])
  ) {
    foreach ($page->access['plugins'] as $plugin_delta => &$plugin) {
      if ($plugin['name'] != 'php') {
        continue;
      }
      output(
        'page',
        array($page->task, $page_id),
        $plugin['settings']['php'],
        array($page_id, 'access', $plugin_delta),
        array($page_name, 'Access', $plugin['settings']['description'])
      );
    }
  }
}

foreach($page_types as &$page_type) {
  foreach ($page_type as $variant_id => &$variant) {
    $variant_name = $variant->conf['title'];
    $page_id = $variant->subtask;
    $page_name = $pages[$page_id]->admin_title;

    if (
      TRUE
      && !empty($variant->conf)
      && !empty($variant->conf['access'])
      && !empty($variant->conf['access']['plugins'])
    ) {
      foreach($variant->conf['access']['plugins'] as $plugin_delta => &$plugin) {
        if ($plugin['name'] != 'php') {
          continue;
        }
        output(
          'variant',
          array($page->task, $page_id, $variant_id),
          $plugin['settings']['php'],
          array($page_id, $variant_id, 'access', $plugin_delta),
          array($page_name, $variant_name, 'Access', $plugin['settings']['description'])
        );

      }
    }

    if (
      TRUE
      && !empty($variant->conf)
      && !empty($variant->conf['display'])
      && !empty($variant->conf['display']->content)
    ) {
      foreach ($variant->conf['display']->content as $pane_id => &$pane) {

        if (
          TRUE
          && $pane->type == 'custom'
          && !empty($pane->configuration)
          && !empty($pane->configuration['format'])
          && $pane->configuration['format'] == 'php_code'
        ) {
          output(
            'variant',
            array($page->task, $page_id, $variant_id),
            $pane->configuration['body'],
            array($page_id, $variant_id, $pane_id, 'content'),
            array($page_name, $variant_name, $pane->configuration['admin_title'], 'Content')
          );
        }

        if (
          TRUE
          && !empty($pane->access)
          && !empty($pane->access['plugins'])
        ) {
          foreach($pane->access['plugins'] as $plugin_delta => &$plugin) {
            if ($plugin['name'] != 'php') {
              continue;
            }
            output(
              'variant',
              array($page->task, $page_id, $variant_id),
              $plugin['settings']['php'],
              array($page_id, $variant_id, $pane_id, 'access', $plugin_delta),
              array($page_name, $variant_name, $pane->configuration['admin_title'], 'Access', $plugin['settings']['description'])
            );
          }
        }

      }
    }

  }
}
