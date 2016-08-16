<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 8/14/16
 * Time: 4:54 PM
 */

namespace Drupal\callout2\Plugin\Filter;

use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;

/**
 * @Filter(
 *   id = "filter_callout2",
 *   title = @Translation("Callout2 Filter"),
 *   description = @Translation("Show callout2s."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE
 * )
 */
class Callout2 extends FilterBase {

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
    //return new FilterProcessResult('DOGS! ' . $text);

    $qp = html5qp($text);
    $callout2s = $qp->find('[data-chunk-type="callout2"]');
    foreach ($callout2s as $callout2) {
      $extra = $callout2->attr('data-extra');
      $content = $callout2->innerHTML5();
      $html =
        '<div class="callout2-extra">More ' . $extra . '</div>'
        . '<div class="callout2-content">' . $content . '</div>'
        . '<div class="callout2-extra">Even more ' . $extra . '</div>';
      $callout2->html5($html);
    }
    return new FilterProcessResult($qp->html5());
  }
}