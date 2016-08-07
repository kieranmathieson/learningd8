<?php

/**
 * @file
 * Contains \Drupal\Core\Menu\LocalTaskDefault.
 */

namespace Drupal\mymodule\Menu;

use Drupal\Core\Menu\LocalTaskDefault;
use Symfony\Component\HttpFoundation\Request;

/**
 * Mymodule local task override.
 */
class LocalTask extends LocalTaskDefault {

  /**
   * {@inheritdoc}
   */
  public function getTitle(Request $request = NULL) {
    return $this->t('View !name at @time', array('!name' => $request->attributes->get('user')->getUsername(), '@time' => format_date(time())));
  }

}
