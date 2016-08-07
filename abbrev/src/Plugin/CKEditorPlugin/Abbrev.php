<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 8/4/16
 * Time: 3:57 PM
 */

namespace Drupal\abbrev\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "Abbrev" plugin.
 *
 * @CKEditorPlugin(
 *   id = "abbr",
 *   label = @Translation("Abbreviation")
 * )
 */
class Abbrev extends CKEditorPluginBase { //implements CKEditorPluginConfigurableInterface {

  /**
   * Returns the buttons that this plugin provides, along with metadata.
   *
   */
  public function getButtons() {
    return array(
      'abbr' => array(
        'label' => t('Abbrev'),
        'image' => drupal_get_path('module', 'abbrev') . '/js/plugins/abbr/icons/abbr.png',
      ),
    );  }

  /**
   * Returns the Drupal root-relative file path to the plugin JavaScript file.
   *
   * Note: this does not use a Drupal library because this uses CKEditor's API,
   * see http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.resourceManager.html#addExternal.
   *
   * @return string|FALSE
   *   The Drupal root-relative path to the file, FALSE if an internal plugin.
   */
  public function getFile() {
    return drupal_get_path('module', 'abbrev') . '/js/plugins/abbr/plugin.js';
  }

  /**
   * Returns the additions to CKEDITOR.config for a specific CKEditor instance.
   */
  public function getConfig(Editor $editor) {
    return [];
//      'abbrev_abbr' => t('Abbreviation'),
//      'abbrev_title' => t('Title')
//    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return [];
//    array(
//      'core/drupal.ajax',
//    );
  }
}