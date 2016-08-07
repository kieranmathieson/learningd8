<?php
/**
 * @file
 * Contains Drupal\plugin_message|MessageSettingsForm.
 */

namespace Drupal\plugin_message;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormStateInterface;


class MessageSettingsForm extends FormBase {

  /**
   * @var \Drupal\plugin_message\MessageManager.
   */
  protected $manager;

  /**
   * @var \Drupal\Core\Config\ConfigFactory.
   */
  protected $config;

  public static function create(ContainerInterface $container) {
    return new static($container->get('plugin.manager.plugin_message'), $container->get('config.factory'));
  }

  public function __construct(MessageManager $manager, ConfigFactoryInterface $config) {
    $this->manager = $manager;
    $this->config = $config;
  }

  public function getFormID() {
    return 'plugin_message_settings_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config->get('plugin_message.settings');
    $options = array();
    foreach($this->manager->getDefinitions() as $plugin_id => $definition) {
      $options[$plugin_id] = $definition['label'];
    }
    $form['message'] = array(
      '#type' => 'select',
      '#title' => t('Select a message'),
      '#options' => $options,
      '#default_value' => $config->get('id'),
      '#empty_option' => t('None'),
      '#empty_value' => 'none',
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {}

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config->getEditable('plugin_message.settings');
    $config->set('id', $form_state->getValue('message'));
    $config->save();
  }
}

