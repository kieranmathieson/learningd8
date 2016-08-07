<?php

/**
 * @file
 * Contains \Drupal\block_face\Plugin\Block\BlockFace.
 */

namespace Drupal\block_face\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a Block Face block.
 *
 * @Block(
 *   id = "block_face",
 *   admin_label = @Translation("Block face")
 * )
 */
class BlockFace extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $output = [
      '#type' => 'markup',
      '#markup' => '<p>Block face</p>',
      '#attached' => [
        'library' =>  [
          'block_face/block-face'
        ],
      ]
    ];

    return $output;
  }




}