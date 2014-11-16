<?php

require_once 'general.inc';

$views = views_get_all_views();
foreach ($views as $view) {
  $view_id = $view->name;
  $view_name = $view->human_name;

/*
  if ($view_id != 'php') {
    continue;
  }
  print_r($view);
*/

  foreach ($view->display as $display_id => $display) {

    $display_name = $display->display_title;

    // fields
    if (
      TRUE
      && !empty($display->display_options)
      && !empty($display->display_options['fields'])
    ) {
      foreach ($display->display_options['fields'] as $field_id => $field) {
        $field_name = $field['label'];
        if ($field['field'] != 'php') {
          continue;
        }

        output(
          'view',
          $view_id,
          $field['php_value'],
          array($view_id, $display_id, 'field', 'value', $field_id),
          array($view_name, $display_name, 'Field', 'Value', $field_name)
        );

        output(
          'view',
          $view_id,
          $field['php_output'],
          array($view_id, $display_id, 'field', 'output', $field_id),
          array($view_name, $display_name, 'Field', 'Output', $field_name)
        );

      }
    }

    // filters
    if (
      TRUE
      && !empty($display->display_options)
      && !empty($display->display_options['filters'])
    ) {
      foreach ($display->display_options['filters'] as $field_id => $field) {
        $field_name = $field_id;
        if ($field['field'] != 'php') {
          continue;
        }

        output(
          'view',
          $view_id,
          $field['php_setup'],
          array($view_id, $display_id, 'filter', 'setup', $field_id),
          array($view_name, $display_name, 'Filter', 'Setup', $field_name)
        );

        output(
          'view',
          $view_id,
          $field['php_filter'],
          array($view_id, $display_id, 'filter', 'filter', $field_id),
          array($view_name, $display_name, 'Filter', 'Filter', $field_name)
        );

      }
    }

    // sorts
    if (
      TRUE
      && !empty($display->display_options)
      && !empty($display->display_options['sorts'])
    ) {
      foreach ($display->display_options['sorts'] as $field_id => $field) {
        $field_name = $field_id;
        if ($field['field'] != 'php') {
          continue;
        }

        output(
          'view',
          $view_id,
          $field['php_setup'],
          array($view_id, $display_id, 'sorts', 'setup', $field_id),
          array($view_name, $display_name, 'Sorts', 'Setup', $field_name)
        );

        output(
          'view',
          $view_id,
          $field['php_sort'],
          array($view_id, $display_id, 'sorts', 'sort', $field_id),
          array($view_name, $display_name, 'Sorts', 'Sort', $field_name)
        );

      }
    }

    // header
    if (
      TRUE
      && !empty($display->display_options)
      && !empty($display->display_options['header'])
    ) {
      foreach ($display->display_options['header'] as $field_id => $field) {
        $field_name = $field['label'];
        if ($field['field'] != 'php') {
          continue;
        }

        output(
          'view',
          $view_id,
          $field['php_output'],
          array($view_id, $display_id, 'header', $field_id),
          array($view_name, $display_name, 'Header', $field_name)
        );

      }
    }

    // footer
    if (
      TRUE
      && !empty($display->display_options)
      && !empty($display->display_options['footer'])
    ) {
      foreach ($display->display_options['footer'] as $field_id => $field) {
        $field_name = $field['label'];
        if ($field['field'] != 'php') {
          continue;
        }

        output(
          'view',
          $view_id,
          $field['php_output'],
          array($view_id, $display_id, 'footer', $field_id),
          array($view_name, $display_name, 'Footer', $field_name)
        );

      }
    }

    // arguments
    if (
      TRUE
      && !empty($display->display_options)
      && !empty($display->display_options['arguments'])
    ) {
      foreach ($display->display_options['arguments'] as $field_id => $field) {
        $field_name = $field_id;

        if (
          TRUE
          && !empty($field['default_argument_type']) 
          && $field['default_argument_type'] == 'php'
          && !empty($field['default_argument_options']) 
        ) {
          output(
            'view',
            $view_id,
            $field['default_argument_options']['code'],
            array($view_id, $display_id, 'arguments', 'default', $field_id),
            array($view_name, $display_name, 'Arguemnts', 'Default', $field_name)
          );
        }

        if (
          TRUE
          && !empty($field['validate']) 
          && !empty($field['validate']['type']) 
          && $field['validate']['type'] == 'php'
          && !empty($field['validate_options']) 
        ) {
          output(
            'view',
            $view_id,
            $field['validate_options']['code'],
            array($view_id, $display_id, 'arguments', 'validate', $field_id),
            array($view_name, $display_name, 'Arguemnts', 'Validate', $field_name)
          );
        }

      }
    }

    // empty
    if (
      TRUE
      && !empty($display->display_options)
      && !empty($display->display_options['empty'])
    ) {
      foreach ($display->display_options['empty'] as $field_id => $field) {
        $field_name = $field['label'];
        if ($field['field'] != 'php') {
          continue;
        }

        output(
          'view',
          $view_id,
          $field['php_output'],
          array($view_id, $display_id, 'empty', $field_id),
          array($view_name, $display_name, 'Empty', $field_name)
        );

      }
    }

    // cache
    if (
      TRUE
      && !empty($display->display_options)
      && !empty($display->display_options['cache'])
      && $display->display_options['cache']['type'] == 'php'
    ) {
      $cache = $display->display_options['cache'];

      output(
        'view',
        $view_id,
        $cache['php_cache_results'],
        array($view_id, $display_id, 'cache', 'results'),
        array($view_name, $display_name, 'Cache', 'Results')
      );

      output(
        'view',
        $view_id,
        $cache['php_cache_output'],
        array($view_id, $display_id, 'cache', 'output'),
        array($view_name, $display_name, 'Cache', 'Output')
      );

    }

    // access
    if (
      TRUE
      && !empty($display->display_options)
      && !empty($display->display_options['access'])
      && $display->display_options['access']['type'] == 'php'
    ) {
      $access = $display->display_options['access'];

      output(
        'view',
        $view_id,
        $access['php_access'],
        array($view_id, $display_id, 'access'),
        array($view_name, $display_name, 'Access')
      );

    }

  }
}
