<?php
/**
 * @file
 * Contains Drupal\plugin_message\MessageManager.
 */

namespace Drupal\plugin_message;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Language\LanguageManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * A plugin manager for message plugins.
 */
class MessageManager extends DefaultPluginManager implements EventSubscriberInterface {

  /**
   * Constructs a MessageManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    $this->alterInfo('plugin_message_info');
    $this->setCacheBackend($cache_backend, 'plugin_message');

    parent::__construct('Plugin/Message', $namespaces, $module_handler, 'Drupal\plugin_message\MessageInterface', 'Drupal\plugin_message\Annotation\Message');
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('setMessage');
    return $events;
  }

  /**
   * Responds to KernelEvents::REQUEST events.
   *
   * Sets a message based on the currently selected plugin.
   */
  public function setMessage(GetResponseEvent $event) {
    $config = \Drupal::config('plugin_message.settings');
    $id = $config->get('id');
    if ($id && $id != 'none') {
      $instance = $this->createInstance($config->get('id'));
      drupal_set_message($instance->message());
    }
  }

}
