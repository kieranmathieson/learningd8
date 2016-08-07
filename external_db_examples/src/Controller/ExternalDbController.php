<?php

namespace Drupal\external_db_examples\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

class ExternalDbController extends ControllerBase {

  public function personnelList() {
    $header = [
      $this->t('Last Name'),
      $this->t('First Name'),
      $this->t('Department'),
    ];
    $rows = [];
    //Can't use dep inj, that's for the Drupal DB.
    $old_db_key = Database::setActiveConnection('personnel'); //Key from settings.php
      //Returns key of previously active connection. Restore it later, in ***
    $connection = Database::getConnection();
    $query = $connection->select('employee', 'e');
    $query->innerJoin('department_employee', 'de', 'e.id = de.employee_id');
    $query->innerJoin('department', 'd', 'de.department_id = d.id');
    $query->fields('e', ['lname', 'fname'])
      ->fields('d', ['name'])
      ->orderBy('d.name', 'ASC')
      ->orderBy('e.lname', 'ASC')
      ->orderBy('e.fname', 'ASC');
    $results = $query->execute();
    foreach ($results as $record) {
      $rows[] = [
        $record->lname,
        $record->fname,
        $record->name,
      ];
    }
    Database::setActiveConnection($old_db_key); //*** Restore Drupal connection.

    return [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }
}