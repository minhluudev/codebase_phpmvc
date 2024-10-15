<?php

use Framework\View;

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
    Auth
</heder>
<br>
<?= View::setSection('content') ?>
</body>
</html>