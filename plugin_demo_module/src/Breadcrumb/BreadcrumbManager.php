<?php

/**
 * @file
 * Contains \Drupal\Core\Breadcrumb\BreadcrumbManager.
 */

namespace Drupal\mymodule\Breadcrumb;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Link;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Url;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Routing\LinkGeneratorTrait;

/**
 * Provides a breadcrumb manager.
 *
 * Can be assigned any number of other BreadcrumbBuilderInterface objects
 * by calling the addBuilder() method, then uses the highest priority one
 * to build breadcrumbs when build() is called.
 */
class BreadcrumbManager implements BreadcrumbBuilderInterface {
  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $route_match) {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    $breadcrumb = new Breadcrumb();
    $breadcrumb->addLink(Link::createFromRoute($this->t('Go home!'), '<front>'));
    // See more at: http://palantir.net/blog/d8ftw-hacking-core-without-killing-kittens#sthash.A07gR8t8.dpuf
    return $breadcrumb;
  }

}
