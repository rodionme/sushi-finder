<?php

namespace Sushi\Controllers;

use \Framework\DatabaseTable;
use \Framework\Authentication;

class Sushi {
  private $authorsTable;
  private $sushiTable;
  private $typesTable;
  private $ingredientsTable;
  private $authentication;

  public function __construct(DatabaseTable $sushiTable,
                              DatabaseTable $authorsTable,
                              DatabaseTable $typesTable,
                              DatabaseTable $ingredientsTable,
                              Authentication $authentication) {
    $this->sushiTable = $sushiTable;
    $this->authorsTable = $authorsTable;
    $this->typesTable = $typesTable;
    $this->ingredientsTable = $ingredientsTable;
    $this->authentication = $authentication;
  }

  public function list() {
    $page = $_GET['page'] ?? 1;
    $offset = ($page - 1) * 10;

    if (isset($_GET['type'])) {
      $type = $this->typesTable->findById($_GET['type']);
      $sushi = $type->getSushi(10, $offset);
      $totalSushi = $type->getNumSushi();
    } else {
      $sushi = $this->sushiTable->findAll('name DESC', 10, $offset);
      $totalSushi = $this->sushiTable->total();
    }

    $title = 'Sushi List';
    $author = $this->authentication->getUser();

    return [
      'template' => 'sushi.html.php',
      'title' => $title,
      'variables' => [
        'totalSushi' => $totalSushi,
        'sushi' => $sushi,
        'user' => $author,
        'types' => $this->typesTable->findAll(),
        'ingredients' => $this->ingredientsTable->findAll(),
        'currentPage' => $page,
        'typeId' => $_GET['type'] ?? null,
      ],
    ];
  }

  public function home() {
    $title = 'Sushi Finder';

    return [
      'template' => 'home.html.php',
      'title' => $title,
    ];
  }

  public function delete() {
    $author = $this->authentication->getUser();
    $sushi = $this->sushiTable->findById($_POST['id']);

    if ($sushi->authorId != $author->id) {
      return;
    }

    $this->sushiTable->delete($_POST['id']);

    header('location: /sushi/list');
  }

  public function saveEdit() {
    $author = $this->authentication->getUser();
    $sushi = $_POST['sushi'];
    $sushiEntity = $author->addSushi($sushi);

    $sushiEntity->clearTypes();
    $sushiEntity->clearIngredients();

    foreach ($_POST['type'] as $typeId) {
      $sushiEntity->addType($typeId);
    }

    foreach ($_POST['ingredient'] as $ingredientId) {
      $sushiEntity->addIngredient($ingredientId);
    }

    header('location: /sushi/list');
  }

  public function edit() {
    $author = $this->authentication->getUser();
    $types = $this->typesTable->findAll();
    $ingredients = $this->ingredientsTable->findAll();

    if (isset($_GET['id'])) {
      $sushi = $this->sushiTable->findById($_GET['id']);
    }

    $title = 'Edit Sushi';

    return [
      'template' => 'editsushi.html.php',
      'title' => $title,
      'variables' => [
        'sushi' => $sushi ?? null,
        'user' => $author,
        'types' => $types,
        'ingredients' => $ingredients,
      ],
    ];
  }
}
