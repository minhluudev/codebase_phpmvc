<?php

use Lumin\View;

View::layout('layouts/auth');
View::section('title', $title ?? '');
?>

<?php
View::sectionStart('content'); ?>
<main>
	<h1 class="title">Login</h1>
	<section class="login__form__container">
		<form action="/login" method="POST">
			<?php if (isset($error)) : ?>
				<div class="message__error"><?= $error ?></div>
			<?php endif ?>
			<div class="form__item">
				<label>Email</label>
				<input type="email" name="email" required>
			</div>
			<br>
			<div class="form__item">
				<label>Password</label>
				<input type="password" name="password" required>
			</div>
			<br>
			<div class="form__item align__item--center">
				<button>Submit</button>
			</div>
		</form>
	</section>
	<div>
		If you don't have an account, <a href="/register">register now.</a>
	</div>
	<div>
		Or go to <a href="/">home page.</a>
	</div>
</main>
<?php View::sectionEnd(); ?>

<?php View::layoutEnd(); ?>