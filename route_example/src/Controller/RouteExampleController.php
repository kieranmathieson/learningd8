<?php
/**
 * Created by PhpStorm.
 * User: kieran
 * Date: 7/22/16
 * Time: 9:18 AM
 */

namespace Drupal\route_example\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;
use Drupal\user\Entity\User;
use Drupal\user\UserInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RouteExampleController extends ControllerBase {

  //Dependency injection - create some fields to hold service objects.
  //They'll be set in the constructor.
  //Note that they are doc'ed as interfaces.

  /**
   * @var \Drupal\Core\Session\AccountProxyInterface;
   */
  protected $curUser;

  /**
   * @var \Drupal\Core\Datetime\DateFormatInterface
   */
  protected $dateFormatter;

  /**
   * @var |Drupal\Core\Entity\entityTypeManagerInterface
   */
  protected $entTypeManager;

  public function __construct(
    AccountProxyInterface $curUser,
    DateFormatterInterface $dateFormatter,
    EntityTypeManagerInterface $entTypeManager
  ) {
    $this->curUser = $curUser;
    $this->dateFormatter = $dateFormatter;
    $this->entTypeManager = $entTypeManager;
  }

  //MAGIC! Drupal tries to call a static create() function afore
  //the constructor.
  public static function create(ContainerInterface $container) {
    //Order matches constructor.
    return new static(
      $container->get('current_user'),
      $container->get('date.formatter'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   */
  public function helloWorld() {

    return [
      '#markup' => $this->t('Hello world!')
    ];
  }

  public function helloUserTitle() {
    $name = $this->curUser->getDisplayName();
    return $this->t('Hello :name!',
      [':name' => $name]
    );
  }

  public function helloUser() {
    $name = $this->curUser->getDisplayName();
    return [
      '#markup' => $this->t('Hello :name! Good to see you.',
        [':name' => $name]
      )
    ];
  }

  public function userInfoTitle(UserInterface $user) {
    $name = $user->getDisplayName();
    return $this->t('Info about user :name',
      [':name' => $name]
    );
  }

  public function userInfo(UserInterface $user) {
    $name = $user->getDisplayName();
    return [
      '#markup' => $this->t('Hello :name! Evil to see you.',
        [':name' => $name]
      )
    ];
  }

  public function nodeList($type, $limit) {
    $query = $this->entTypeManager->getStorage('node')->getQuery();
    if ( $type != 'all' ) {
      $query->condition('type', $type);
    }
    $query->range(1, $limit);
    $nids = $query->execute();
    $nodes = $this->entTypeManager->getStorage('node')
      ->loadMultiple($nids);
    $header = [
      $this->t('ID'),
      $this->t('type'),
      $this->t('title'),
    ];
    $rows=[];
    foreach ($nodes as $node) {
      $rows[] = [
        $node->id(),
        $node->bundle(),
        $node->getTitle(),
      ];
    }
    return [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

  public function nodeCompare(NodeInterface $node1, NodeInterface $node2) {
    $diff = $node1->getChangedTime() - $node2->getChangedTime();
    return [
      '#markup' => $this->t(
        'Created time difference: :diff seconds',
        [':diff' => $diff,]
      )
    ];
  }

  public function userInfoAccess(AccountInterface $account, UserInterface $user) {
    if ($account->hasPermission('view any user info')) {
      return AccessResult::allowed();
    }
    if ($account->hasPermission('view own user info') && $account->id() == $user->id() ) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }

}
