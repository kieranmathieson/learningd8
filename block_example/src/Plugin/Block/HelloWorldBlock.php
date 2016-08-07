<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 7/21/16
 * Time: 10:00 AM
 */

namespace Drupal\block_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Hello world block.
 *
 * @Block(
 *   id = "block_example_hello_world",
 *   admin_label = @Translation("Block example: Hello world"),
 *   category = @Translation("Examples")
 * )
 */
class HelloWorldBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('Hello world!'),
    ];
  }

}
