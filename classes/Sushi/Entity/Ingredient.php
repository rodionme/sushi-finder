<?php

namespace Sushi\Entity;

use Framework\DatabaseTable;

class Ingredient {
  public $id;
  public $name;
  private $sushiTable;
  private $sushiIngredientsTable;

  public function __construct(DatabaseTable $sushiTable, DatabaseTable $sushiIngredientsTable) {
    $this->sushiTable = $sushiTable;
    $this->sushiIngredientsTable = $sushiIngredientsTable;
  }

  public function getSushi($limit = null, $offset = null) {
    $sushiIngredients = $this->sushiIngredientsTable->find('ingredientId', $this->id, null, $limit, $offset);

    $sushi = [];

    foreach ($sushiIngredients as $sushiIngredient) {
      $singleSushi = $this->sushiTable->findById($sushiIngredient->sushiId);

      if ($singleSushi) {
        $sushi[] = $singleSushi;
      }
    }

    usort($sushi, [$this, 'sortSushi']);

    return $sushi;
  }

  private function sortSushi($a, $b) {
    $aName = $a->name;
    $bName = $b->name;

    if ($aName == $bName) {
      return 0;
    }

    return $aName < $bName ? -1 : 1;
  }
}
