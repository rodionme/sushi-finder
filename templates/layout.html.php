<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/main.css">
  <title><?= $title ?></title>
</head>

<body>
  <nav>
    <header>
      <h1>Sushi Finder</h1>
    </header>

    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/sushi/list">Sushi List</a></li>
      <li><a href="/type/list">Types List</a></li>
      <li><a href="/ingredient/list">Ingredients List</a></li>
      <?php if ($loggedIn): ?>
        <li><a href="/logout">Log out</a></li>
      <?php else: ?>
        <li><a href="/login">Log in</a></li>
      <?php endif; ?>
    </ul>
  </nav>

  <main>
    <?= $output ?>
  </main>
</body>
</html>
