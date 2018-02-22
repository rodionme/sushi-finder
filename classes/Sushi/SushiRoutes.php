<?php

namespace Sushi;

class SushiRoutes implements \Framework\Routes {
  private $authorsTable;
  private $sushiTable;
  private $categoriesTable;
  private $sushiTypesTable;
  private $authentication;

  public function __construct() {
    include __DIR__ . '/../../includes/DatabaseConnection.php';

    $this->sushiTable = new \Framework\DatabaseTable($pdo, 'sushi', 'id', '\Sushi\Entity\Sushi', [&$this->authorsTable, &$this->sushiTypesTable]);
    $this->authorsTable = new \Framework\DatabaseTable($pdo, 'author', 'id', '\Sushi\Entity\Author', [&$this->sushiTable]);
    $this->categoriesTable = new \Framework\DatabaseTable($pdo, 'type', 'id', '\Sushi\Entity\Type', [&$this->sushiTable, &$this->sushiTypesTable]);
    $this->sushiTypesTable = new \Framework\DatabaseTable($pdo, 'sushi_type', 'typeId');
    $this->authentication = new \Framework\Authentication($this->authorsTable, 'email', 'password');
  }

  public function getRoutes(): array {
    $sushiController = new \Sushi\Controllers\Sushi($this->sushiTable, $this->authorsTable, $this->categoriesTable, $this->authentication);
    $authorController = new \Sushi\Controllers\Register($this->authorsTable);
    $loginController = new \Sushi\Controllers\Login($this->authentication);
    $typeController = new \Sushi\Controllers\Type($this->categoriesTable);

    return [
      'author/register' => [
        'GET' => [
          'controller' => $authorController,
          'action' => 'registrationForm',
        ],
        'POST' => [
          'controller' => $authorController,
          'action' => 'registerUser',
        ],
      ],

      'author/success' => [
        'GET' => [
          'controller' => $authorController,
          'action' => 'success',
        ],
      ],

      'sushi/list' => [
        'GET' => [
          'controller' => $sushiController,
          'action' => 'list',
        ],
      ],

      'sushi/edit' => [
        'POST' => [
          'controller' => $sushiController,
          'action' => 'saveEdit',
        ],
        'GET' => [
          'controller' => $sushiController,
          'action' => 'edit',
        ],
        'login' => true,
      ],

      'sushi/delete' => [
        'POST' => [
          'controller' => $sushiController,
          'action' => 'delete',
        ],
        'login' => true,
      ],

      'login' => [
        'GET' => [
          'controller' => $loginController,
          'action' => 'loginForm',
        ],
        'POST' => [
          'controller' => $loginController,
          'action' => 'processLogin',
        ],
      ],

      'login/error' => [
        'GET' => [
          'controller' => $loginController,
          'action' => 'error',
        ],
      ],

      'login/permissionserror' => [
        'GET' => [
          'controller' => $loginController,
          'action' => 'permissionsError',
        ],
      ],

      'login/success' => [
        'GET' => [
          'controller' => $loginController,
          'action' => 'success',
        ],
      ],

      'logout' => [
        'GET' => [
          'controller' => $loginController,
          'action' => 'logout',
        ],
      ],

      'type/list' => [
        'GET' => [
          'controller' => $typeController,
          'action' => 'list',
        ],
        'login' => true,
      ],

      'type/edit' => [
        'POST' => [
          'controller' => $typeController,
          'action' => 'saveEdit',
        ],
        'GET' => [
          'controller' => $typeController,
          'action' => 'edit',
        ],
        'login' => true,
      ],

      'type/delete' => [
        'POST' => [
          'controller' => $typeController,
          'action' => 'delete',
        ],
        'login' => true,
      ],

      '' => [
        'GET' => [
          'controller' => $sushiController,
          'action' => 'home',
        ],
      ],
    ];
  }

  public function getAuthentication(): \Framework\Authentication {
    return $this->authentication;
  }
}