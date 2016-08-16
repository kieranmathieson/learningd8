<?php

namespace Drupal\h1\Controller;

use Drupal\Core\Controller\ControllerBase;
use Masterminds\HTML5;
//use QueryPath\QueryPath;

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
    $html = '<p>Dogs are the best!</p>'
      . '<div data-chunk-type="dog" data-breed="lab">'
      .   'This is not here, no.'
      . '</div>'
      . '<div data-chunk-type="cat" data-breed="siamese">'
      .   'This is a cat here.'
      . '</div>';


//    $dom = new HTML5();
//    $dom->loadHTML($html);
//
//    $html5 = new HTML5();
//    $dom = $html5->loadHTML($html);
    $qp = html5qp($html);
    $dog = $qp->find('[data-chunk-type="dog"]');
    if ( $dog->count() > 1 ) {
      $dog = $dog->get(0);
    }
    try {
      $content = $dog->innerHTML5();
//      $result = 'The dog is a ' . $dog->attr('data-breed');
      $new_dog = '<div style="background-color: #ffffdd">'
        . '<img src="http://r.ddmcdn.com/s_f/o_1/APL/uploads/2014/10/10-tips-324x2051.jpg">'
        . '<span class="menu-item">'.$content.'</span>'
        . '</div>';
      $result = $new_dog;
    }

    catch (Exception $e) {
      $result = $e->getMessage();
    }
    return [
      '#type' => 'markup',
      '#markup' => $result,
    ];

  }

}
