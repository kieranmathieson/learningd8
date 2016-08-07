<?php

/**
 * @file
 * Contains \Drupal\blindd8\BlindD8Subscriber.
 */

namespace Drupal\trails;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\EventDispatcher\GenericEvent;

class TrailsSubscriber implements EventSubscriberInterface {



    public function rememberIt(GetResponseEvent $event) {
//        \Drupal::state()->delete('trails_history');
        $history = \Drupal::state()->get('trails_history') ?: array();
        $request = \Drupal::request();
        $route_match = \Drupal::routeMatch();
        $title = \Drupal::service('title_resolver')->getTitle($request, $route_match->getRouteObject());
        $path = $request->getUri();
//        $path = $request->getPathInfo();
//        drupal_set_message('Path: ' . $path);
//        drupal_set_message(\Drupal::url('<front>'));
//        drupal_set_message('Path: ' . $path);
//        drupal_set_message('TItle: ' . $title);
//        drupal_set_message('getPahtinfo: ' . $request->getPathInfo());
        if ( $request->getPathInfo() == \Drupal::url('<front>') ) {
//            drupal_set_message('thing');
//            drupal_set_message('Front: ' . \Drupal::url('<front>'));
            $title = 'Home';
        }
        $history[] = array(
            'title' => strip_tags($title),
            'path' => $path,
            'timestamp' => REQUEST_TIME,
        );
        \Drupal::state()->set('trails_history', $history);


    }
    /**
     * {@inheritdoc}
     */
    static function getSubscribedEvents(){
        $events[KernelEvents::REQUEST][] = array('rememberIt');
        return $events;
    }

}