<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/main.css">
  <link rel="icon" type="image/png" href="/favicon.png">
  <title><?= $title ?></title>
</head>

<body>
  <header>
    <a class="logo" href="/"><h1>Sushi Finder</h1></a>
  </header>

  <nav class="main-menu">
    <ul class="menu-list">
      <li class="menu-item"><a href="/sushi/list">Sushi</a></li>
      <li class="menu-item"><a href="/type/list">Types</a></li>
      <li class="menu-item"><a href="/ingredient/list">Ingredients</a></li>
      <?php if ($loggedIn): ?>
        <li class="menu-item"><a href="/logout">Log out</a></li>
      <?php else: ?>
        <li class="menu-item"><a href="/login">Log in</a></li>
      <?php endif; ?>
    </ul>
  </nav>

  <main>
    <?= $output ?>
  </main>
</body>
</html>
