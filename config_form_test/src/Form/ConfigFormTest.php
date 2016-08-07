<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 8/3/16
 * Time: 2:47 PM
 */

namespace Drupal\config_form_test\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigFormTest extends ConfigFormBase {

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return ['config_form_test.dog'];
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'config_form_test_dog_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    drupal_set_message('Name: ' . $this->config('config_form_test.dog')->get('dog_name'));
    $form['dog_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Dog name'),
      '#default_value' => $this->config('config_form_test.dog')->get('dog_name'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message('dog save: ' .  $form_state->getValue('dog_name'));
    parent::submitForm($form, $form_state);
    $this->config('config_form_test.dog')->set('dog_name', $form_state->getValue('dog_name'));
  }

  /**
   * @inheritDoc
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    if ( $form_state->isValueEmpty('dog_name') ) {
      $form_state->setErrorByName('dog_name', $this->t('Please enter a dog name.'));
    }
  }
}