<?php

use Lumin\View;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= View::setSection('title') ?></title>
</head>
<body>
<heder>
    <a href="/">Home</a> |
    <a href="/about">About</a> |
    <a href="/login">Login</a> |
    <a href="/admin">Admin</a>
</heder>
<br>
<?= View::setSection('content') ?>
</body>
</html>