<?php

namespace Drupal\trails\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\ImageToolkit\ImageToolkitManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configures image toolkit settings for this site.
 */
class TrailsSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'trails_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['trails.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Retrieve existing configuration for this block.
    $trailsBlockMax = $this->config('trails.settings')->get('trails_block_max');

    $range = range(1, 200);

    $form['trails_block_max'] = array(
      '#type' => 'select',
      '#title' => $this->t('Maximum number of items to display'),
      '#options' => array_combine($range, $range),
      '#default_value' => $trailsBlockMax,
      '#description' => $this->t('This will set the maximum allowable number that can be displayed in a history block'),
      '#required' => TRUE,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
//  public function validateForm(array &$form, FormStateInterface $form_state) {
//    parent::validateForm($form, $form_state);
//
//    // Call the form validation handler for each of the toolkits.
//    foreach ($this->availableToolkits as $toolkit) {
//      $toolkit->validateConfigurationForm($form, $form_state);
//    }
//  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('trails.settings')
      ->set('trails_block_max', $form_state->getValue('trails_block_max'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
