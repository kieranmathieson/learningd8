<?php

/**
 * @file
 * Contains \Drupal\mymodule\Plugin\Block\MyBlock.
 */

namespace Drupal\mymodule\Plugin\Block;

// This abstract class provides all the stubs methods needed to satisfy
// the \Drupal\block\BlockPluginInterface except build().
use Drupal\Core\Block\BlockBase;
// For Annotation parsing, so we can just have the alias @Block.
// The annotation parser will create an instance of this class using
// the values found in the annotation.
use Drupal\Core\Block\Annotation\Block;
// For Annotation parsing, so we can just have the alias @Translation.
// The annotation parser will instantiate this class which translates interface
// strings from the annotation.
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Url;

/**
 * Provides a block with 'Mymodule' links.
 *
 * @Block(
 *   id = "mymodule_my_block",
 *   admin_label = @Translation("Mymodule block")
 * )
 */
class MyBlock extends BlockBase {

  public function build() {
    return [
      'first_link' => [
        '#prefix' => '<p>',
        '#type' => 'link',
        '#title' => $this->t('Mymodule List'),
        '#url' => Url::fromRoute('mymodule.list'),
        '#suffix' => '</p>',
      ],
      'second_link' => [
        '#prefix' => '<p>',
        '#type' => 'link',
        '#title' => $this->t('Mymodule Settings'),
        '#url' => Url::fromRoute('mymodule.settings'),
        '#suffix' => '</p>',
      ],
    ];
  }
}
