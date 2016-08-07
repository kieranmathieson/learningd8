<?php
/**
 * Contains Drupal\plugin_message\Plugin\Message\RedRoses.
 */

namespace Drupal\plugin_message\Plugin\Message;

use Drupal\plugin_message\Annotation\Message;
use Drupal\Core\Annotation\Translation;
use Drupal\plugin_message\MessageInterface;

/**
 * @Message(
 *   id = "red_roses",
 *   label = @Translation("Red Roses")
 * )
 */
class RedRoses implements MessageInterface {

  /**
   * {@inheritdoc}
   */
  public function message() {
    return t('Roses are red...');
  }

}
