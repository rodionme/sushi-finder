<?php
namespace Sushi\Entity;

class Author {
	public $id;
	public $email;
	public $password;
	private $sushiTable;

	public function __construct(\Framework\DatabaseTable $sushiTable) {
		$this->sushiTable = $sushiTable;
	}

	public function getSushi() {
		return $this->sushiTable->find('authorId', $this->id);
	}

	public function addSushi($sushi) {
    $sushi['authorId'] = $this->id;

		return $this->sushiTable->save($sushi);
	}
}
