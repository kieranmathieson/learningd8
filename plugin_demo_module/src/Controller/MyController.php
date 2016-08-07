<?php

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;

class MyController extends ControllerBase {

  public function dolist() {
    return [
      '#markup' => __METHOD__
    ];
  }

  public function settings() {
    return [
      '#markup' => __METHOD__
    ];
  }

}
