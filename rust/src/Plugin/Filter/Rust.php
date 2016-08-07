<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 8/3/16
 * Time: 4:02 PM
 */

namespace Drupal\rust\Plugin\Filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;

use Gregwar\RST\Parser;

/**
 * @Filter(
 *   id = "rust",
 *   title = @Translation("RuST"),
 *   description = @Translation("ReStructuredText for Drupal."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 *   settings = {
 *      "animal" = FALSE
 *   }
 * )
 */
class Rust extends FilterBase {

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
    $parser = new Parser();
    $text = strip_tags($text, '<img>');
    $text = $parser->parse($text);
    ksm($text);
//    $animal = $this->settings['animal'] ? 'LLAMAS' : 'DOGS';
//    $text = $animal . $text;
    return new FilterProcessResult($text);
  }

  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['animal'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Show llamas?'),
      '#default_value' => $this->settings['animal'],
      '#description' => $this->t('What animal to add?'),
    );
    return $form;
  }
}