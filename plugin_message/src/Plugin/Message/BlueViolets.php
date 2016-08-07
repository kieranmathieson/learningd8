<?php
/**
 * Contains Drupal\plugin_message\Plugin\Message\BlueViolets.
 */

namespace Drupal\plugin_message\Plugin\Message;

use Drupal\plugin_message\Annotation\Message;
use Drupal\Core\Annotation\Translation;
use Drupal\plugin_message\MessageInterface;

/**
 * @Message(
 *   id = "blue_violets",
 *   label = @Translation("Blue Violets")
 * )
 */
class BlueViolets implements MessageInterface {

  /**
   * {@inheritdoc}
   */
  public function message() {
    return t('Violets are blue...');
  }

}
