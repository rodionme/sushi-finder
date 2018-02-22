<div class="sushilist">

  <ul class="categories">
    <?php foreach ($types as $type): ?>
      <li><a href="/sushi/list?type=<?= $type->id ?>"><?= $type->name ?></a><li>
    <?php endforeach; ?>
  </ul>

  <div class="sushi">
    <p><?= $totalSushi ?> sushi have been submitted to the Sushi Finder.</p>

    <?php foreach ($sushi as $singleSushi): ?>
      <blockquote>
        <?= (new \Framework\Markdown($singleSushi->name))->toHtml() ?>

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

    Select page:

    <?php
    $numPages = ceil($totalSushi / 10);

    for ($i = 1; $i <= $numPages; $i++):
      if ($i == $currentPage):
        ?>
        <a class="currentpage"
           href="/sushi/list?page=<?= $i ?><?= !empty($categoryId) ? '&category=' . $categoryId : '' ?>"><?= $i ?></a>
      <?php else: ?>
        <a href="/sushi/list?page=<?= $i ?><?= !empty($categoryId) ? '&category=' . $categoryId : '' ?>"><?= $i ?></a>
      <?php endif; ?>
    <?php endfor; ?>
  </div>
