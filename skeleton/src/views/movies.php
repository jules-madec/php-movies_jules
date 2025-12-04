<?php ob_start() ?>

<h1>Ma Collection</h1>
<form method="post">
    <label for="">titre</label>
    <input id="firstname" type="text" name="title" required>
    <label for="genre">le Genre</label>
    <select name="type" id="pet-select">
        <option value="Film">Film</option>
        <option value="Serie">Serie</option>
    </select>

    <label for="email">genre</label>
    <input id="email" type="text" name="genre" required>

    <button type="submit" name="la">soumettre</button>
</form>

<?php
render('default', true, [
    'title' => 'Acceuil',
    'css' => 'index',
    'content' => ob_get_clean(),
]);
?>