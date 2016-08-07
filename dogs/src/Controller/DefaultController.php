<?php

namespace Drupal\dogs\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class DefaultController.
 *
 * @package Drupal\dogs\Controller
 */
class DefaultController extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello($name) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: hello with parameter(s): ' . $name),
    ];
  }

  public function evalNumberDogs($number) {
    $evaluator = \Drupal::service('dogs.evalnumberservice');
    $recommendation = $evaluator->evalNumber($number);
    return [
      '#type' => 'markup',
      '#markup' => $this->t($recommendation),
    ];
  }

  public function makeDogs() {
    $storage = \Drupal::entityTypeManager()->getStorage('node');
    $scooby = $storage->create([
      'type' => 'dog',
      'title' => 'Scooby',
    ]);
    $scooby->body->value = 'Scooby scooby doooo!';
    $scooby->save();
    return [
      '#type' => 'markup',
      '#markup' => 'Made scoob',
    ];
  }

}
