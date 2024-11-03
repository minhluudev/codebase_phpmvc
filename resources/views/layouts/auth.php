<?php

use Lumin\View;

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= View::setSection('title') ?> | Auth Lumin</title>
	<link rel="stylesheet" href="/assets/styles.css">
</head>

<body>
	<?= View::setSection('content') ?>
</body>

</html>