<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 7/22/16
 * Time: 2:25 PM
 */

namespace Drupal\route_example\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class ExampleRouteSubscriber extends RouteSubscriberBase {

  /**
   * Alters existing routes for a specific collection.
   *
   * @param \Symfony\Component\Routing\RouteCollection $collection
   *   The route collection for adding routes.
   */
  public function alterRoutes(RouteCollection $collection) {
    $route = $collection->get('user.logout');
    if ( $route ) {
      $route->setPath('/hello-world');
    }
    $route = $collection->get('system.admin_structure');
    if ( $route ) {
      $route->setDefault('_title', 'DOGS!');
    }
  }
}