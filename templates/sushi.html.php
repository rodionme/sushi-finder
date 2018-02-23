<div class="sushilist">

  <ul class="types">
    <?php foreach ($types as $type): ?>
      <li><a href="/sushi/list?type=<?= $type->id ?>"><?= $type->name ?></a><li>
    <?php endforeach; ?>
  </ul>

  <div class="sushi">
    <p><?= $totalSushi ?> sushi have been submitted to the Sushi Finder.</p>

    <a href="/sushi/edit">Add a new Sushi</a>

    <?php foreach ($sushi as $singleSushi): ?>
      <blockquote>
        <?= $singleSushi->name ?>

        <span><?= htmlspecialchars($types[0]->name, ENT_QUOTES, 'UTF-8') ?></span>

        <?php foreach ($ingredients as $ingredient): ?>
          <blockquote>
            <p><?= htmlspecialchars($ingredient->name, ENT_QUOTES, 'UTF-8') ?></p>
          </blockquote>
        <?php endforeach; ?>

        <?php if ($user): ?>
          <?php if ($user->id == $singleSushi->authorId): ?>
            <a href="/sushi/edit?id=<?= $singleSushi->id ?>">Edit</a>
          <?php endif; ?>

          <?php if ($user->id == $singleSushi->authorId): ?>
            <form action="/sushi/delete" method="post">
              <input type="hidden" name="id" value="<?= $singleSushi->id ?>">
              <input type="submit" value="Delete">
            </form>
          <?php endif; ?>
        <?php endif; ?>
      </blockquote>
    <?php endforeach; ?>

    <?php
    $numPages = ceil($totalSushi / 10);

    if ($numPages > 1): ?>
      <span>Select page:</span>

      <?php for ($i = 1; $i <= $numPages; $i++):
        if ($i == $currentPage): ?>
          <a class="currentpage"
             href="/sushi/list?page=<?= $i ?><?= !empty($typeId) ? '&type=' . $typeId : '' ?>"><?= $i ?></a>
        <?php else: ?>
          <a href="/sushi/list?page=<?= $i ?><?= !empty($typeId) ? '&type=' . $typeId : '' ?>"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
    <?php endif; ?>
  </div>
</div>
