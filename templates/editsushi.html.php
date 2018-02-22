<?php if (empty($sushi->id) || $user->id == $sushi->authorId): ?>

  <form action="" method="post">
    <input type="hidden" name="sushi[id]" value="<?= $sushi->id ?? '' ?>">

    <label for="name">Type your joke here:</label>
    <textarea id="name" name="sushi[name]" rows="3" cols="40"><?= $sushi->name ?? '' ?></textarea>

    <p>Select types for this joke:</p>

    <?php foreach ($types as $type): ?>

      <?php if ($sushi && $sushi->hasType($type->id)): ?>
        <input type="checkbox" checked name="type[]" value="<?= $type->id ?>" />
      <?php else: ?>
        <input type="checkbox" name="type[]" value="<?= $type->id ?>" />
      <?php endif; ?>

      <label><?= $type->name ?></label>
    <?php endforeach; ?>

    <input type="submit" name="submit" value="Save">
  </form>

<?php else: ?>

  <p>You may only edit sushi that you posted.</p>

<?php endif; ?>
