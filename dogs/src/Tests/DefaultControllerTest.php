<?php

namespace Drupal\dogs\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the dogs module.
 * @group Dogs
 */
class DefaultControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "dogs DefaultController's controller functionality",
      'description' => 'Test Unit for module dogs and controller DefaultController.',
      'group' => 'test_dogs',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests dogs functionality.
   */
  public function testDefaultController() {
    // Check that the basic functions of module dogs.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
