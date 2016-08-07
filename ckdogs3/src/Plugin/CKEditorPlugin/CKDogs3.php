<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 8/5/16
 * Time: 10:36 AM
 */

namespace Drupal\ckdogs3\Plugin\CKEditorPlugin;


use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the plugin.
 *
 * @CKEditorPlugin(
 *   id = "ckdogs3",
 *   label = @Translation("ckdogs3")
 * )
 */
class ckdogs3 extends CKEditorPluginBase {
  /**
   * Returns the buttons that this plugin provides, along with metadata.
   *
   */
  public function getButtons() {
    return array(
      'ckdogs3' => array(
        'label' => t('ckdogs3'),
        'image' => drupal_get_path('module', 'ckdogs3')
          . '/js/plugins/ckdogs3/icons/ckdogs3.png',
      ),
    );  }

  /**
   * Returns the Drupal root-relative file path to the plugin JavaScript file.
   */
  public function getFile() {
    return drupal_get_path('module', 'ckdogs3') . '/js/plugins/ckdogs3/plugin.js';
  }

  /**
   * Returns the additions to CKEDITOR.config for a specific CKEditor instance.
   */
  public function getConfig(Editor $editor) {
    return [];
//      'abbrev_abbr' => t('ckdogs3'),
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
