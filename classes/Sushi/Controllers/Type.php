<?php

namespace Sushi\Controllers;

class Type {
  private $typesTable;

  public function __construct(\Framework\DatabaseTable $typesTable) {
    $this->typesTable = $typesTable;
  }

  public function edit() {
    if (isset($_GET['id'])) {
      $type = $this->typesTable->findById($_GET['id']);
    }

    $title = 'Edit Type';

    return [
      'template' => 'edittype.html.php',
      'title' => $title,
      'variables' => [
        'type' => $type ?? null,
      ],
    ];
  }

  public function saveEdit() {
    $type = $_POST['type'];

    $this->typesTable->save($type);

    header('location: /type/list');
  }

  public function list() {
    $types = $this->typesTable->findAll();

    $title = 'Sushi Types';

    return [
      'template' => 'types.html.php',
      'title' => $title,
      'variables' => [
        'types' => $types,
      ],
    ];
  }

  public function delete() {
    $this->typesTable->delete($_POST['id']);

    header('location: /type/list');
  }
}
