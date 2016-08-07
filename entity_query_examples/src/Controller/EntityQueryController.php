<?php

namespace Drupal\entity_query_examples\Controller;

use Drupal\Core\Controller\ControllerBase;

class EntityQueryController extends ControllerBase {

  public function userList() {
    $query = $this->entityTypeManager()->getStorage('user')->getQuery();
    $query->condition('name', 'a%', 'LIKE'); //Find users with names starting with r.
    $results = $query->execute();
    ksm($results);

    $header = [
      $this->t('Username'),
      $this->t('Email'),
    ];
    $rows = [];

    $users = $this->entityTypeManager()->getStorage('user')->loadMultiple($results);
    ksm($users);
    foreach ($users as $user) {
      $rows[] = [
        $user->getDisplayName(),
        $user->getEmail()
      ];
    }

    return [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

  public function nodeList() {
    $query = $this->entityTypeManager()->getStorage('node')->getQuery();
    $query->notExists('field_state') //Field does not have a value.
      ->condition('type', 'article')
      ->sort('title');
    $results = $query->execute();
    $nodes = $this->entityTypeManager()->getStorage('node')->loadMultiple($results);

    $header = [
      $this->t('ID'),
      $this->t('Type'),
      $this->t('Title'),
      $this->t('Author'),
    ];
    $rows = [];
    foreach ($nodes as $node) {
      $rows[] = [
        $node->id(),
        $node->bundle(),
        $node->getTitle(),
        $node->getOwner()->getDisplayName(),
      ];
    }

    return [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

}