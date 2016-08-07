<?php

/**
 * @file
 * Contains \Drupal\blindd8\BlindD8ingService.
 */

namespace Drupal\dogs;

class EvalNumberService {
  public function evalNumber( $number ) {
    $result = '';
    if ( $number < 0 ) {
      $result = 'Can\'t have negative dogs!';
    }
    else if ( $number == 0 ) {
      $result = 'Get some dogs!';
    }
    else if ( $number == 1 ) {
      $result = 'You need another dog.';
    }
    else if ( $number == 2 ) {
      $result = 'That\'s the right number of dogs.';
    }
    else {
      $result = 'Too many dogs!';
    }
    return $result;
  }
}