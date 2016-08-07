<?php

/**
 * @file
 * Contains \Drupal\blindd8\Controller\Blindd8Controller.
 */

namespace Drupal\blindd8\Controller;

use Drupal\blindd8\BlindD8NotableEvent;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Defines a controller to experiment with.
 */
class Blindd8Controller extends ControllerBase
{

    /**
     * Provides a page that we can experiment with.
     *
     * @return array
     *   A render array as expected by drupal_render().
     */
    public function content()
    {
        $string = 'This is the default string';
        $event = new BlindD8NotableEvent($string);
        \Drupal::service('event_dispatcher')->dispatch('blindd8.notable_event', $event);
        $string = $event->getString();

        // Get our username
        $account = \Drupal::currentUser(); // Another way of using \Drupal::service('current_user');
        $name = $account->getUsername();

        // Generate a UUID
        $uuid_generator = \Drupal::service('uuid');
        $uuid = $uuid_generator->generate();

        $blindd8ingservice = \Drupal::service('blindd8.blindd8ingservice');
//        $tagline = $blindd8ingservice->getTagline();
        $tagline = 'Dooogs!';
        // Send it forth!
        $output = array(
            '#markup' => $this->t('Hey, @name, here\'s a unique ID for you: @uuid. @tagline @string', array('@name' => $name, '@uuid' => $uuid, '@tagline' => $tagline, '@string' => $string)),
        );
        return $output;
    }
}