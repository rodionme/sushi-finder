<?php

namespace Sushi\Entity;

class Sushi {
  public $id;
  public $name;
  public $authorId;
  private $authorsTable;
  private $author;
  private $sushiTypesTable;

  public function __construct(\Framework\DatabaseTable $authorsTable, \Framework\DatabaseTable $sushiTypesTable) {
    $this->authorsTable = $authorsTable;
    $this->sushiTypesTable = $sushiTypesTable;
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
}
