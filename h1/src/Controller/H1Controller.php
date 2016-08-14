<?php

namespace Drupal\h1\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class H1Controller.
 *
 * @package Drupal\h1\Controller
 */
class H1Controller extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function h1() {
    return [
        '#type' => 'markup',
        '#markup' => $this->t('Implement method: h1'),
    ];
  }

  public function h2() {
    $html = '<p>Dogs are the best!</p>';
    $dom = new \DOMDocument();
    // Ignore warnings during HTML soup loading.
    @$dom->loadHTML($html);
    $el = $dom->createElement('p');
    $el->appendChild($dom->createTextNode('DOGZ!'));
    $dom->appendChild($el);
    return [
        '#type' => 'markup',
        '#markup' => $dom->saveHTML(),
    ];
  }

  public function h3() {
    $html = '<p>Dogs are the best!</p>';
    $dom = new \DOMDocument();
    // Ignore warnings during HTML soup loading.
    @$dom->loadHTML($html);

  }

}
