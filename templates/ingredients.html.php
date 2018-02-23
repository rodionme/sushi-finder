<h2>Sushi Ingredients</h2>

<a href="/ingredient/edit">Add a new ingredient</a>


<?php foreach ($ingredients as $ingredient): ?>
  <blockquote>
    <p>
      <?= htmlspecialchars($ingredient->name, ENT_QUOTES, 'UTF-8') ?>

      <a href="/ingredient/edit?id=<?= $ingredient->id ?>">Edit</a>

      <form action="/ingredient/delete" method="post">
        <input type="hidden" name="id" value="<?= $ingredient->id ?>">
        <input type="submit" value="Delete">
      </form>
    </p>
  </blockquote>

<?php endforeach; ?>
