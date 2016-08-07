<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 7/21/16
 * Time: 12:48 PM
 */

namespace Drupal\block_example\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a contact info block.
 *
 * @Block(
 *   id = "block_example_contact_info",
 *   admin_label = @Translation("Block example: Contact info"),
 *   category = @Translation("Examples")
 * )
 */
class ContactInfoBlock extends BlockBase {
  /**
   * @inheritDoc
   */
  public function defaultConfiguration() {
    return [
      'phone' => '',
      'email' => '',
    ];
  }


  /**
   * @inheritDoc
   */
  public function build() {
    return [
      '#markup' =>
        '<div>' . $this->t('Phone number: :phone', [':phone' => $this->configuration['phone']]).'</div>'
        . '<div>' . $this->t('Email: :email', [':email' => $this->configuration['email']]).'</div>'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['phone'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Phone number'),
      '#default_value' => $this->configuration['phone'],
      '#required' => TRUE,
    );
    $form['email'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#default_value' => $this->configuration['email'],
      '#required' => TRUE,
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    if ( ! $form_state->getErrors() ) {
      $this->configuration['phone'] = $form_state->getValue('phone');
      $this->configuration['email'] = $form_state->getValue('email');
    }
    parent::blockSubmit($form, $form_state);
  }
}