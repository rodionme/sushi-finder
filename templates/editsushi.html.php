<?php if (empty($sushi->id) || $user->id == $sushi->authorId): ?>

  <form action="" method="post">
    <input type="hidden" name="sushi[id]" value="<?= $sushi->id ?? '' ?>">

    <label for="name">Type your sushi name here:</label>
    <input id="name" name="sushi[name]" type="text" value="<?= $sushi->name ?? '' ?>">

    <label for="altname">Type your sushi alternative names here:</label>
    <textarea id="altname" name="altname[name]" rows="3" cols="40"><?= $sushi->altname ?? '' ?></textarea>


    <!-- Types -->

    <p>Select types for this sushi:</p>

    <?php foreach ($types as $type): ?>

      <label>
        <?php if ($sushi && $sushi->hasType($type->id)): ?>
          <input type="checkbox" checked name="type[]" value="<?= $type->id ?>" />
        <?php else: ?>
          <input type="checkbox" name="type[]" value="<?= $type->id ?>" />
        <?php endif; ?>

        <?= $type->name ?>
      </label>
    <?php endforeach; ?>


    <!-- Ingredients -->

    <p>Select ingredients for this sushi:</p>

    <?php foreach ($ingredients as $ingredient): ?>

      <label>
        <?php if ($sushi && $sushi->hasIngredient($ingredient->id)): ?>
          <input type="checkbox" checked name="ingredient[]" value="<?= $ingredient->id ?>" />
        <?php else: ?>
          <input type="checkbox" name="ingredient[]" value="<?= $ingredient->id ?>" />
        <?php endif; ?>

        <?= $ingredient->name ?>
      </label>
    <?php endforeach; ?>

    <button type="submit">Save</button>
  </form>

<?php else: ?>

  <p>You may only edit sushi that you posted.</p>

<?php endif; ?>
