<form action="" method="post">
  <input type="hidden" name="type[id]" value="<?= $type->id ?? '' ?>">

  <label for="type">Enter type name:</label>
  <input type="text" id="type" name="type[name]" value="<?= $type->name ?? '' ?>" />

  <button type="submit">Save</button>
</form>
