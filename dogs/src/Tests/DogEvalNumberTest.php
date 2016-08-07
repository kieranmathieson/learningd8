<?php


namespace Drupal\dogs\Tests; //\Unit;

use Drupal\Tests\UnitTestCase;

/**
 * Demonstrates how to write tests.
 *
 * @group Dogs
 */
class DogEvalNumberTest extends UnitTestCase {

  public $service;

  public function setUp() {
    $this->service = new \Drupal\dogs\EvalNumberService();
  }

  public function testNegativeDogs() {
    $this->assertEquals('Can\'t have negative dogs!', $this->service->evalNumber(-10));
  }

  public function testNoDogs() {
    $this->assertEquals('Get some dogs!', $this->service->evalNumber(0));
  }

  public function testOneDogs() {
    $this->assertEquals('You need another dog.', $this->service->evalNumber(1));
  }

  public function testTwoDogs() {
    $this->assertEquals('That\'s the right number of dogs.', $this->service->evalNumber(2));
  }

  /**
   *
   */
  public function testTooManyDogs() {
    $correct = 'Too many dogs!';
    $this->assertEquals($correct, $this->service->evalNumber(3));
    $this->assertEquals($correct, $this->service->evalNumber(33));
    $this->assertEquals($correct, $this->service->evalNumber(333));
  }

}