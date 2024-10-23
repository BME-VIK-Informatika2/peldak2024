<?php

if (isset($_POST['comment'])) {

    if (!isset($_POST['secure'])) {
        $comment = $_POST['comment'];
    } else {
        $comment = htmlspecialchars($_POST['comment']);
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XSS</title>
</head>
<body>
<h1>Hozzászólások</h1>

<?php if (isset($comment)): ?>
    <h2>A te hozzászólásod:</h2>
    <p><?= $comment ?></p>
<?php endif; ?>

<form method="post">
    <label for="comment">Írj egy hozzászólást:</label>
    <br><br>
    <textarea id="comment" name="comment" rows="3" cols="64"><script>alert('XSS támadás');</script></textarea>
    <br><br>
    <label for="secure">XSS elleni védelem:</label>
    <input type="checkbox" id="secure" name="secure">
    <br><br>
    <input type="submit" value="Küldés">
</form>
</body>
</html>

<img src="http://your-website.com/change_password.php?new_password=password">