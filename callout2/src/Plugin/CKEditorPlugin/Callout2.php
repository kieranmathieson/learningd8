<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 8/6/16
 * Time: 10:22 AM
 */

namespace Drupal\callout2\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the plugin.
 *
 * @CKEditorPlugin(
 *   id = "callout2",
 *   label = @Translation("Callout2")
 * )
 */
class Callout2 extends CKEditorPluginBase {


  public function getButtons() {
    return array(
      'callout2' => array(
        'label' => t('callout2'),
        'image' => drupal_get_path('module', 'callout2')
          . '/js/plugins/callout2/icons/callout2.png',
      ),
    );
  }

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
    return drupal_get_path('module', 'callout2')
      . '/js/plugins/callout2/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }
}