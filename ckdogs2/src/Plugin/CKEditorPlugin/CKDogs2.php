<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 8/5/16
 * Time: 10:36 AM
 */

namespace Drupal\ckdogs2\Plugin\CKEditorPlugin;


use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the plugin.
 *
 * @CKEditorPlugin(
 *   id = "ckdogs2",
 *   label = @Translation("ckdogs2")
 * )
 */
class ckdogs2 extends CKEditorPluginBase {
  /**
   * Returns the buttons that this plugin provides, along with metadata.
   *
   */
  public function getButtons() {
    return array(
      'ckdogs2' => array(
        'label' => t('ckdogs2'),
        'image' => drupal_get_path('module', 'ckdogs2')
          . '/js/plugins/ckdogs2/icons/ckdogs2.png',
      ),
    );  }

  /**
   * Returns the Drupal root-relative file path to the plugin JavaScript file.
   */
  public function getFile() {
    return drupal_get_path('module', 'ckdogs2') . '/js/plugins/ckdogs2/plugin.js';
  }

  /**
   * Returns the additions to CKEDITOR.config for a specific CKEditor instance.
   */
  public function getConfig(Editor $editor) {
    return [];
//      'abbrev_abbr' => t('ckdogs2'),
//      'abbrev_title' => t('Title')
//    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return [];
  }



}
