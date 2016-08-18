<?php

namespace Drupal\dom_test\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the dom_test module.
 */
class DefaultControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "dom_test DefaultController's controller functionality",
      'description' => 'Test Unit for module dom_test and controller DefaultController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests dom_test functionality.
   */
  public function testDefaultController() {
    // Check that the basic functions of module dom_test.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
