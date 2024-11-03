<?php

use Lumin\View;

View::layout('layouts/auth');
View::section('title', $title ?? '');
?>

<?php
View::sectionStart('content'); ?>
<main>
	<h1 class="title">Register</h1>
	<section class="login__form__container">
		<form action="/register" method="POST">
			<?php if (isset($error)) : ?>
				<div class="message__error">
					<ul style="margin: 0; padding-left: 5px;">
						<?php foreach ($error as $key => $values) {
							foreach ($values as $value) {
								echo "<li>$value</li>";
							}
						} ?>
					</ul>
				</div>
			<?php endif ?>
			<div class="form__item">
				<label>Full name</label>
				<input type="text" name="full_name" required value="<?= isset($_POST['full_name']) ? $_POST['full_name'] : '' ?>">
			</div>
			<br>
			<div class="form__item">
				<label>Email</label>
				<input type="email" name="email" required value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
			</div>
			<br>
			<div class="form__item">
				<label>Password</label>
				<input type="password" name="password" required value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>">
			</div>
			<br>
			<div class="form__item">
				<label>Confirm password</label>
				<input type="password" name="password_confirm" required value="<?= isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '' ?>">
			</div>
			<br>
			<div class="form__item align__item--center">
				<button>Submit</button>
			</div>
		</form>
	</section>
	<div>
		If you have an account, <a href="/login">login now.</a>
	</div>
	<div>
		Or go to <a href="/">home page.</a>
	</div>
</main>
<?php View::sectionEnd(); ?>

<?php View::layoutEnd(); ?>