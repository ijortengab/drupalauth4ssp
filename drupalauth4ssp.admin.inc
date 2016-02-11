<?php
/**
 * @file
 * Admin form for drupalauth4ssp module.
 */

/**
 * Implements settings for the module.
 */
function drupalauth4ssp_settings() {
  $form['drupalauth4ssp_setup'] = array(
    '#type' => 'fieldset',
    '#title' => t('Basic Setup'),
    '#collapsible' => FALSE,
  );
  $form['drupalauth4ssp_setup']['drupalauth4ssp_installdir'] = array(
    '#type' => 'textfield',
    '#title' => t('Installation directory (default: /var/simplesamlphp)'),
    '#default_value' => variable_get('drupalauth4ssp_installdir', NULL),
    '#description' => t('The base directory of simpleSAMLphp. Absolute path with no trailing slash.'),
  );
  $form['drupalauth4ssp_setup']['drupalauth4ssp_authsource'] = array(
    '#type' => 'textfield',
    '#title' => t('Authentication source (The one that uses the drupalauth:External class)'),
    '#default_value' => variable_get('drupalauth4ssp_authsource', NULL),
    '#description' => t('The simpleSAMLphp authentication source.'),
  );

  return system_settings_form($form);
}
