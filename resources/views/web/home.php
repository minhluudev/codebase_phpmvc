<?php

use Lumin\View;

View::layout('layouts/main');
View::section('title', $title ?? 'Home page');
?>

<?php
View::sectionStart('content'); ?>
<main>
	<h1 class="title">Lumin Framework</h1>
	<div class="subtitle">Version: 1.x</div>
	<div>
		<a href="/admin">Admin</a> |
		<a href="/login">Login</a> |
		<a href="/register">Register</a>
	</div>
	<section>
		<h1>Welcome to Lumin</h1>
		<p>This is the home page</p>
	</section>
</main>
<?php View::sectionEnd(); ?>

<?php View::layoutEnd(); ?>