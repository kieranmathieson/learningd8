<?php
/**
 * @file
 * Contains Drupal\plugin_message\Annotation\Message.
 */

namespace Drupal\plugin_message\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * A message plugin annotation.
 *
 * @Annotation
 */
class Message extends Plugin {

  /**
   * The administrative label for this message.
   *
   * @var string
   */
  protected $label;

}