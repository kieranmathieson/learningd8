<?php

namespace Drupal\dom_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Utility\Html;

/**
 * Class DefaultController.
 *
 * @package Drupal\dom_test\Controller
 */
class DefaultController extends ControllerBase {

  public $html;

  static public function innerHTML(\DOMElement $element) {
    $doc = $element->ownerDocument;

    $html = '';

    foreach ($element->childNodes as $node) {
      $html .= $doc->saveHTML($node);
    }

    return $html;
  }

  public function __construct() {
    $this->html = '<div data-dog-type="lab" data-legs="4" data-name="Oscar">'
      . 'Oscar is <em>great</em>!</div>'
      . '<div data-dog-type="mix" data-legs="4" data-name="Renata">'
      . 'Renata is great!</div>'
      . '<div data-cow-type="jersey" data-legs="4" data-name="Nellie" data-horms="2">'
      . 'Nellie is OK.</div>';
  }

  /**
   * T1.
   *
   * @return string
   *   Return Hello string.
   */
  public function t1() {
    /* @var $div \DOMElement */
    $document = Html::load($this->html);
    $divs = $document->getElementsByTagName('div');
    $dog_names = '';
    foreach ($divs as $div) {
      if ($div->hasAttribute('data-dog-type')) {
        $dog_names .= $div->getAttribute('data-name') . ' ';
      }
    }
    return [
      '#type' => 'markup',
      '#markup' => $this->t($dog_names)
    ];
  }

  /**
   * T2.
   *
   * @return string
   *   Return Hello string.
   */
  public function t2() {
    /* @var $div \DOMElement */
    $document = Html::load($this->html);
    $divs = $document->getElementsByTagName('div');
    $output = '';
    foreach ($divs as $div) {
      if ($div->hasAttribute('data-dog-type')) {
        $animal_type = 'Dog (' . ucfirst($div->getAttribute('data-dog-type')) . ')';
      }
      else {
        if ($div->hasAttribute('data-cow-type')) {
          $animal_type = 'Cow (' . ucfirst($div->getAttribute('data-cow-type')) . ')';
        }
      }
      $animal_name = $div->getAttribute('data-name');
      $content = DefaultController::innerHTML($div);
      $new_content = $animal_name . ': ' . $animal_type . '. ' . $content;
      $output .= '<p>' . $new_content . '</p>';
    }
    return [
      '#type' => 'markup',
      '#markup' => $output
    ];
  }

}
