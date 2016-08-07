<?php

/**
 * @file
 * Contains \Drupal\mymodule\Plugin\Filter\NodeLinkFilter.
 */

namespace Drupal\mymodule\Plugin\Filter;

use Drupal\Core\Link;
use Drupal\filter\Annotation\Filter;
use Drupal\Core\Annotation\Translation;
use Drupal\filter\FilterProcessResult;
use \Drupal\filter\Plugin\FilterInterface;
use Drupal\filter\Plugin\FilterBase;
use Drupal\node\Entity\Node;

/**
 * Provides a filter to format a node ID as a link.
 *
 * @Filter(
 *   id = "mymodule_node_link",
 *   module = "mymodule",
 *   title = @Translation("Format a node ID as a link"),
 *   weight = 0
 * )
 */
class NodeLinkFilter extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function getType() {
    return FilterInterface::TYPE_MARKUP_LANGUAGE;
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $nodes = [];

    $callback =  function ($matches) use ($langcode, &$nodes) {
      if (isset($matches[1])) {
        $node = Node::load($matches[1]);
        if ($node) {
          $nodes[$node->id()] = $node;
          $link = new Link($node->getTitle(), $node->toUrl());
          return $link->toString();
        }
      }
      // If we haven't already returned a replacement, return the original text.
      return $matches[0];
    };

    $regex = '(?:(?<!\w)\[#(\d+(?:-[\d\.]+)?)\](?!\w))|<pre>.*?<\/pre>|<code>.*?<\/code>|<a(?:[^>"\']|"[^"]*"|\'[^\']*\')*>.*?<\/a>';
    $text = preg_replace_callback("/$regex/", $callback, $text);
    $result = new FilterProcessResult($text);
    foreach ($nodes as $node) {
      $result->setCacheTags($node->getCacheTags());
    }
    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    if ($long) {
      return $this->t("References to nodes IDs in the form of [#1234] turn into links automatically, with the title of the node as the link text.");
    }
    else {
      return $this->t('Node ID numbers (ex. [#12345]) turn into links automatically.');
    }
  }

}
