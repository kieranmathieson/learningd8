<?php
/**
 * @file
 *
 * Contains \Drupal\Tests\test_dogs\Functional\DogsEvalNumberFunctionalTest.
 */

namespace Drupal\dogs\Tests; //\Functional;

use Drupal\simpletest\WebTestBase; //Drupal\Tests\BrowserTestBase;

/**
 * Check if dog advice works.
 *
 * @group Dogs
 * @runTestsInSeparateProcesses disabled
 * @preserveGlobalState disabled
 */
class DogsEvalNumberFunctionalTest extends WebTestBase { //BrowserTestBase {

  /**
   * Enabled modules
   */
  //public static $modules = ['dogs'];

  public static function getInfo() {
    return array(
      'name' => "dogs number advice functionality",
      'description' => 'Test Unit for module dogs and advice.',
      'group' => 'test_dogs',
    );
  }

  /**
   * {@inheritdoc}
   */
  function setUp() {
    parent::setUp();
  }

  public function testNoDogs() {
//    $this->assertFalse(2>3, 'This is here');
//    return;

    $content = $this->drupalGet('/dogs/number/0');
    $this->assertFalse( strpos($content, 'Get some dogs!') !== FALSE );
  }

}