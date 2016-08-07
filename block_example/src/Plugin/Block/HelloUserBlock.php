<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 7/21/16
 * Time: 10:00 AM
 */

namespace Drupal\block_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\user\Entity\User;

/**
 * Provides a Hello user block.
 *
 * @Block(
 *   id = "block_example_hello_user",
 *   admin_label = @Translation("Block example: Hello user"),
 *   category = @Translation("Examples")
 * )
 */
class HelloUserBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $user = User::load(
      \Drupal::currentUser()->id()
    );
    $name = $user->getDisplayName();
    $lastLoginTime =  \Drupal::service('date.formatter')->format(
      $user->getLastLoginTime()
    );
    return [
      '#markup' =>
        $this->t('Hello :name.<br><br>Last login: :lastLogin',
          [ ':name' => $name, ':lastLogin' => $lastLoginTime ]),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function blockAccess(AccountInterface $account) {
    //Don't show for anon.
    if ( $account->isAnonymous() ) {
      return \Drupal\Core\Access\AccessResult::forbidden();
    }
    //Forbid display if this is not a user account page.
    $route_name = \Drupal::routeMatch()->getRouteName();
    if ( $route_name != 'entity.user.canonical' ) {
      return \Drupal\Core\Access\AccessResult::forbidden();
    }
    //Forbid if this is not the logged in user's account page.
    $route_account = \Drupal::routeMatch()->getParameter('user');
    ksm($route_name, $route_account);
    if ( empty($route_account) || $route_account->id() != $account->id() ) {
      return \Drupal\Core\Access\AccessResult::forbidden();
    }
    //Let parent figure out access.
    return parent::blockAccess($account);
  }


}
