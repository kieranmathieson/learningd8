<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 8/5/16
 * Time: 10:36 AM
 */

namespace Drupal\ckdogs1\Plugin\CKEditorPlugin;


use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the plugin.
 *
 * @CKEditorPlugin(
 *   id = "ckdogs1",
 *   label = @Translation("CKDogs1")
 * )
 */
class CKDogs1 extends CKEditorPluginBase {
  /**
   * Returns the buttons that this plugin provides, along with metadata.
   *
   */
  public function getButtons() {
    return array(
      'ckdogs1' => array(
        'label' => t('Ckdogs1'),
        'image' => drupal_get_path('module', 'ckdogs1')
          . '/js/plugins/ckdogs1/icons/ckdogs1.png',
      ),
    );  }

  /**
   * Returns the Drupal root-relative file path to the plugin JavaScript file.
   */
  public function getFile() {
    return drupal_get_path('module', 'ckdogs1') . '/js/plugins/ckdogs1/plugin.js';
  }

  /**
   * Returns the additions to CKEDITOR.config for a specific CKEditor instance.
   */
  public function getConfig(Editor $editor) {
    return [];
//      'abbrev_abbr' => t('CKDogs1'),
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