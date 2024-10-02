<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= isset($title) ? $title : '' ?></title>
</head>

<body>
	<header>
		<a href="/">Home</a> |
		<a href="/articles">Article</a> |
		<a href="/login">Login</a> |
		<a href="/register">Register</a>
	</header>
	<hr />
	<main>
		{{content}}
	</main>
	<footer>Footer</footer>
</body>

</html>