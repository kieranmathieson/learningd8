<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 6/6/16
 * Time: 1:03 PM
 */

namespace Drupal\trails\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Trails' block.
 *
 * @Block(
 *   id = "trails_block",
 *   admin_label = @Translation("History"),
 * )
 */
class TrailsHistoryBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $trail = \Drupal::state()->get('trails_history') ?: array();

    // Create list of previous paths.
    $reverse_trail = array_reverse($trail);

    // Grab the number of items to display
    $config = $this->getConfiguration();
    $num_items = $config['trails_block_num'] ?: 5;

    // Output the latest items as a list
    $output = ''; // Initialize variable, this was added after the video was created.
    for ($i = 0; $i < $num_items; $i++) {
      if ($item = $reverse_trail[$i]) {
        $path = $item['path'] ?: 'http://google.com';
        $p = \Drupal\Core\Url::fromUri($path);
        $output .= '<li>' . \Drupal::l($item['title'], $p) . ' - '
          . \Drupal::service('date.formatter')
            ->formatInterval(REQUEST_TIME - $item['timestamp'])
          . ' ' . $this->t('ago') . '</li>';
      }
    }

    if (isset($output)) {
      $output = '
            <p>' . $this->t('Below are the last :num pages you have visited.', array(':num' => $num_items)) . '</p>
            <ul>' . $output . '</ul>
          ';
    }

    return array(
      '#theme' => 'trails',
//      '#num_items' => $num_items,
    );
    
    return array(
      '#theme' => 'trails_list',
      '#title' => $this->t('History'),
      '#markup' => $output,
      '#cache' => array(
        'max-age' => 0,
      ),
    );
    
    
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['label_display' => TRUE];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    //Get module config.
    $moduleConfig = \Drupal::config('trails.settings');
    $maxToDisplay = $moduleConfig->get('trails_block_max');

    // Retrieve existing configuration for this block.
    $blockConfig = $this->getConfiguration();
    $numItemsToShow = $blockConfig['trails_block_num'] ?: 5;
    // Add a select box of numbers form 1 to $max_to_display.
    $range = range(1, $maxToDisplay);
    $form['trails_block_num'] = array(
      '#type' => 'select',
      '#title' => t('Number of items to show'),
      '#default_value' => $numItemsToShow,
      '#options' => array_combine($range, $range),
      '#cache' => array(
        'max-age' => array(0),
      ),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save our custom settings when the form is submitted.
    $this->setConfigurationValue('trails_block_num', $form_state->getValue('trails_block_num'));
  }
}



