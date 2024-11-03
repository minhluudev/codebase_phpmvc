<?php

use Lumin\View;

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= View::setSection('title') ?> | Admin Lumin</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f0f0f0;
		}

		main {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		main>h1.title {
			color: #333;
		}

		main>div.subtitle {
			color: #666;
		}

		section {
			background-color: #fff;
			margin: 20px;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			width: 50%;
		}

		@media (max-width: 768px) {
			section {
				width: 80%;
			}
		}
	</style>
</head>

<body>
	<?= View::setSection('content') ?>
</body>

</html>