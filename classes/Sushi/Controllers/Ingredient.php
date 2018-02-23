<?php

namespace Sushi\Controllers;

class Ingredient {
  private $ingredientsTable;

  public function __construct(\Framework\DatabaseTable $ingredientsTable) {
    $this->ingredientsTable = $ingredientsTable;
  }

  public function edit() {
    if (isset($_GET['id'])) {
      $ingredient = $this->ingredientsTable->findById($_GET['id']);
    }

    $title = 'Edit Ingredient';

    return [
      'template' => 'editingredient.html.php',
      'title' => $title,
      'variables' => [
        'ingredient' => $ingredient ?? null,
      ],
    ];
  }

  public function saveEdit() {
    $ingredient = $_POST['ingredient'];

    $this->ingredientsTable->save($ingredient);

    header('location: /ingredient/list');
  }

  public function list() {
    $ingredients = $this->ingredientsTable->findAll();

    $title = 'Sushi Types';

    return [
      'template' => 'ingredients.html.php',
      'title' => $title,
      'variables' => [
        'ingredients' => $ingredients,
      ],
    ];
  }

  public function delete() {
    $this->ingredientsTable->delete($_POST['id']);

    header('location: /ingredient/list');
  }
}
