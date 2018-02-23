<div class="content">
  <p class="intro"><?= $totalSushi ?> sushi have been submitted to the Sushi Finder.</p>

  <div class="sushi-list">
    <div class="sushi">
      <a class="link" href="/sushi/edit">Add a new Sushi</a>

      <table>
        <thead>
          <tr>
            <th><span>Name</span></th>
            <th><span>Type</span></th>
            <th><span>Ingredients</span></th>
            <th colspan="2"><span>Actions</span></th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($sushi as $singleSushi): ?>
            <tr>
              <td>
                <span><?= $singleSushi->name ?></span>
              </td>

              <td>
                <span><?= htmlspecialchars($types[0]->name, ENT_QUOTES, 'UTF-8') ?></span>
              </td>

              <td>
                <ul class="ingredients-list">
                  <?php foreach ($ingredients as $ingredient): ?>
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
  <h3>Filters will be here</h3>
</aside>
