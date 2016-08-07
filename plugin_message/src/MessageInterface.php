<?php
/**
 * @file
 * Contains Drupal\plugin_message\MessageInterface.
 */

namespace Drupal\plugin_message;


interface MessageInterface {

  /**
   * Returns a message from the plugin.
   *
   * @return string
   */
  public function message();

}