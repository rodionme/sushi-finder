<h2>Sushi Types</h2>

<a href="/type/edit">Add a new type</a>


<?php foreach ($types as $type): ?>
  <blockquote>
    <p>
      <?= htmlspecialchars($type->name, ENT_QUOTES, 'UTF-8') ?>

      <a href="/type/edit?id=<?= $type->id ?>">Edit</a>

      <form action="/type/delete" method="post">
        <input type="hidden" name="id" value="<?= $type->id ?>">
        <input type="submit" value="Delete">
      </form>
    </p>
  </blockquote>

<?php endforeach; ?>
