<?php

namespace Sushi\Entity;

use Framework\DatabaseTable;

class Type {
  public $id;
  public $name;
  private $sushiTable;
  private $sushiTypesTable;

  public function __construct(DatabaseTable $sushiTable, DatabaseTable $sushiTypesTable) {
    $this->sushiTable = $sushiTable;
    $this->sushiTypesTable = $sushiTypesTable;
  }

  public function getSushi($limit = null, $offset = null) {
    $sushiTypes = $this->sushiTypesTable->find('tyId', $this->id, null, $limit, $offset);

    $sushi = [];

    foreach ($sushiTypes as $sushiType) {
      $sushi = $this->sushiTable->findById($sushiType->sushiId);

      if ($sushi) {
        $sushi[] = $sushi;
      }
    }

    usort($sushi, [$this, 'sortSushi']);

    return $sushi;
  }

  public function getNumSushi() {
    return $this->sushiTypesTable->total('typeId', $this->id);
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
