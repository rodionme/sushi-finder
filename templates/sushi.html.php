<div class="content">
  <p class="intro"><?= $totalSushi ?> sushi have been submitted to the Sushi Finder.</p>

  <div class="sushi-list">
    <div class="sushi">
      <a class="link" href="/sushi/edit">Add a new Sushi</a>

      <table>
        <thead>
          <tr>
            <th><span>Name</span></th>
            <th><span>Alt. Name</span></th>
            <th><span>Type</span></th>
            <th><span>Ingredients</span></th>
            <?php if ($user): ?>
              <th colspan="2"><span>Actions</span></th>
            <?php endif; ?>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($sushi as $singleSushi): ?>
            <tr>
              <td>
                <span><?= $singleSushi->name ?></span>
              </td>

              <td>
                <span><?= $singleSushi->altName ?></span>
              </td>

              <td>
                <?php foreach ($singleSushi->getTypes() as $type): ?>
                  <span><?= htmlspecialchars($type->name, ENT_QUOTES, 'UTF-8') ?></span>
                <?php endforeach; ?>
              </td>

              <td>
                <ul class="ingredients-list">
                  <?php foreach ($singleSushi->getIngredients() as $ingredient): ?>
                    <li class="list-item">
                      <span class="ingredient"><?= htmlspecialchars($ingredient->name, ENT_QUOTES, 'UTF-8') ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </td>

              <?php if ($user): ?>
                <td>
                  <?php if ($user->id == $singleSushi->authorId): ?>
                    <a href="/sushi/edit?id=<?= $singleSushi->id ?>">Edit</a>
                  <?php endif; ?>
                </td>

                <td>
                  <?php if ($user->id == $singleSushi->authorId): ?>
                    <form action="/sushi/delete" method="post">
                      <input type="hidden" name="id" value="<?= $singleSushi->id ?>">
                      <input type="submit" value="Delete">
                    </form>
                  <?php endif; ?>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php
      $numPages = ceil($totalSushi / 10);

      if ($numPages > 1): ?>
        <div class="pagination">
          <span>Select page:</span>

          <?php for ($i = 1; $i <= $numPages; $i++):
            if ($i == $currentPage): ?>
              <a class="page current" href="/sushi/list?page=<?= $i ?><?= !empty($typeId) ? '&type=' . $typeId : '' ?>"><?= $i ?></a>
            <?php else: ?>
              <a class="page" href="/sushi/list?page=<?= $i ?><?= !empty($typeId) ? '&type=' . $typeId : '' ?>"><?= $i ?></a>
            <?php endif; ?>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<aside class="filters">
  <h3>Filters</h3>

  <form action="" method="post">
    <p>Types:</p>

    <?php foreach ($types as $type): ?>
      <label>
        <?php if (!empty($_POST['type']) && $_POST['type'] == $type->id): ?>
          <input type="radio" checked name="type" value="<?= $type->id ?>" />
        <?php else: ?>
          <input type="radio" name="type" value="<?= $type->id ?>" />
        <?php endif; ?>


        <?= $type->name ?>
      </label>
    <?php endforeach; ?>

    <label>
      <?php if (empty($_POST['type'])): ?>
        <input type="radio" checked name="type" value="" />
      <?php else: ?>
        <input type="radio" name="type" value="" />
      <?php endif; ?>
      Doesn't matter
    </label>


    <p>Ingredients:</p>

    <?php foreach ($ingredients as $ingredient): ?>
      <label>
        <?php
        $selectedIngredients = $_POST['ingredient'] ?? [];

        if (in_array($ingredient->id, $selectedIngredients)): ?>
          <input type="checkbox" checked name="ingredient[]" value="<?= $ingredient->id ?>" />
        <?php else: ?>
          <input type="checkbox" name="ingredient[]" value="<?= $ingredient->id ?>" />
        <?php endif; ?>

        <?= $ingredient->name ?>
      </label>
    <?php endforeach; ?>

    <button type="submit">Submit</button>
  </form>
</aside>
