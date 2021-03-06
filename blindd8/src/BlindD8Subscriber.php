<?php

/**
 * @file
 * Contains \Drupal\blindd8\BlindD8Subscriber.
 */

namespace Drupal\blindd8;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Subscribes to the kernel request event to completely obliterate the default content.
 *
 * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
 *   The event to process.
 */
class BlindD8Subscriber implements EventSubscriberInterface {

    /**
     * Overrides the content and serves a 404 status code.
     *
     * @param \Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
     *   The response event, which we will take over like like a boss.
     */
    public function onResponse(FilterResponseEvent $event) {

        $route_name = \Drupal::request()->get(RouteObjectInterface::ROUTE_NAME);
        if ($route_name == 'blindd8.page') {
            $response = $event->getResponse();
            $response->setContent('Blind date, get it?!');
            //$response->setStatusCode('404');
        }
    }

    /**
     * Redirects the user when they're requesting our nearly blank page.
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
     *   The response event.
     */
    public function checkForRedirect(GetResponseEvent $event) {

        $route_name = \Drupal::request()->get(RouteObjectInterface::ROUTE_NAME);
        if ($route_name == 'blindd8.page') {
            drupal_set_message('Because the page you were about to access does not actually have much on it, we are redirecting you to something more useful.');
            $event->setResponse(new RedirectResponse(\Drupal::url('<front>'))); // This is what we do in D8 instead of drupal_goto('<front>');
        }
    }


    public function onNotableEvent(BlindD8NotableEvent $event) {
        $event->setString('Dog!');
    }

    /**
     * {@inheritdoc}
     */
    static function getSubscribedEvents(){
        //$events[KernelEvents::RESPONSE][] = array('onResponse', 100);
        //$events[KernelEvents::REQUEST][] = array('checkForRedirect');
        $events['blindd8.notable_event'][] = array('onNotableEvent');
        return $events;
    }

}