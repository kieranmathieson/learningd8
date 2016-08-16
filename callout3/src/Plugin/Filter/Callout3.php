<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 8/14/16
 * Time: 4:54 PM
 */

namespace Drupal\callout3\Plugin\Filter;

use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;

/**
 * @Filter(
 *   id = "filter_callout3",
 *   title = @Translation("Callout3 Filter"),
 *   description = @Translation("Show callout3s."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE
 * )
 */
class Callout3 extends FilterBase {

  /**
   * Performs the filter processing.
   *
   * @param string $text
   *   The text string to be filtered.
   * @param string $langcode
   *   The language code of the text to be filtered.
   *
   * @return \Drupal\filter\FilterProcessResult
   *   The filtered text, wrapped in a FilterProcessResult object, and possibly
   *   with associated assets, cacheability metadata and placeholders.
   *
   * @see \Drupal\filter\FilterProcessResult
   */
  public function process($text, $langcode) {
    $qp = html5qp($text);
    $callout3s = $qp->find('[data-chunk-type="callout3"]');
    foreach ($callout3s as $callout3) {
      $extra = $callout3->attr('data-extra');
      $content = $callout3->innerHTML5();
      $html =
        '<div class="callout3-extra">More ' . $extra . '</div>'
        . '<div class="callout3-content">' . $content . '</div>'
        . '<div class="callout3-extra">Even more ' . $extra . '</div>';
      $callout3->html5($html);
    }
    return new FilterProcessResult($qp->html5());
  }
}
