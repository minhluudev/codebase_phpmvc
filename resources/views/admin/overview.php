<?php

use Lumin\View;

View::layout('layouts/admin');
View::section('title', $title ?? 'Overview');
?>

<?php
View::sectionStart('content'); ?>
<main>
	<h1 class="title">Lumin Framework</h1>
	<div class="subtitle">Version: 1.x</div>
	<section>
		<h1>Welcome to Lumin - Admin</h1>
		<p>This is the overview page</p>
	</section>
</main>
<?php View::sectionEnd(); ?>

<?php View::layoutEnd(); ?>