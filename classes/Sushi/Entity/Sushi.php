<?php

namespace Sushi\Entity;

class Sushi {
  public $id;
  public $name;
  public $authorId;
  private $authorsTable;
  private $author;
  private $typesTable;
  private $sushiTypesTable;
  private $ingredientsTable;
  private $sushiIngredientsTable;

  public function __construct(\Framework\DatabaseTable $authorsTable,
                              \Framework\DatabaseTable $typesTable,
                              \Framework\DatabaseTable $sushiTypesTable,
                              \Framework\DatabaseTable $ingredientsTable,
                              \Framework\DatabaseTable $sushiIngredientsTable) {
    $this->authorsTable = $authorsTable;
    $this->typesTable = $typesTable;
    $this->sushiTypesTable = $sushiTypesTable;
    $this->ingredientsTable = $ingredientsTable;
    $this->sushiIngredientsTable = $sushiIngredientsTable;
  }

  public function getAuthor() {
    if (empty($this->author)) {
      $this->author = $this->authorsTable->findById($this->authorId);
    }

    return $this->author;
  }

  public function addType($typeId) {
    $sushiType = [
      'sushiId' => $this->id,
      'typeId' => $typeId,
    ];

    $this->sushiTypesTable->save($sushiType);
  }

  public function getTypes() {
    $types = [];
    $sushiTypes = $this->sushiTypesTable->find('sushiId', $this->id);

    foreach ($sushiTypes as $sushiType) {
      $types[] = $this->typesTable->findById($sushiType->typeId);
    }

    return $types;
  }

  public function hasType($typeId) {
    $sushiTypes = $this->sushiTypesTable->find('sushiId', $this->id);

    foreach ($sushiTypes as $sushiType) {
      if ($sushiType->typeId == $typeId) {
        return true;
      }
    }
  }

  public function clearTypes() {
    $this->sushiTypesTable->deleteWhere('sushiId', $this->id);
  }

  public function addIngredient($ingredientId) {
    $sushiIngredient = [
      'sushiId' => $this->id,
      'ingredientId' => $ingredientId,
    ];

    $this->sushiIngredientsTable->save($sushiIngredient);
  }

  public function getIngredients() {
    $ingredients = [];
    $sushiIngredients = $this->sushiIngredientsTable->find('sushiId', $this->id);

    foreach ($sushiIngredients as $sushiIngredient) {
      $ingredients[] = $this->ingredientsTable->findById($sushiIngredient->ingredientId);
    }

    return $ingredients;
  }

  public function hasIngredient($ingredientId) {
    $sushiIngredients = $this->sushiIngredientsTable->find('sushiId', $this->id);

    foreach ($sushiIngredients as $sushiIngredient) {
      if ($sushiIngredient->ingredientId == $ingredientId) {
        return true;
      }
    }
  }

  public function clearIngredients() {
    $this->sushiIngredientsTable->deleteWhere('sushiId', $this->id);
  }
}
