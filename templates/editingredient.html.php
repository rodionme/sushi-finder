<form action="" method="post">
  <input type="hidden" name="ingredient[id]" value="<?= $ingredient->id ?? '' ?>">

  <label for="ingredient">Enter ingredient name:</label>
  <input type="text" id="ingredient" name="ingredient[name]" value="<?= $ingredient->name ?? '' ?>" />

  <button type="submit">Save</button>
</form>
