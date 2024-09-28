<?php
if (isset($model)) {
	$user = $model['user'];
	$errors = $model['errors'];
}

?>
<form method="post" action="/register">
	<h3>Register page</h3>
	<div>
		<label>Full name: </label><br />
		<input type="text" name="full_name" value="<?= isset($user['full_name']) ? $user['full_name'] : '' ?>">
		<?php if (isset($errors['full_name'])): ?>
			<span>Error: <?= implode(', ', $errors['full_name']) ?></span>
		<?php endif ?>
	</div>
	<br />
	<div>
		<label>Email: </label><br />
		<input type="email" name="email" value="<?= isset($user['email']) ? $user['email'] : '' ?>">
		<?php if (isset($errors['email'])): ?>
			<span>Error: <?= implode(', ', $errors['email']) ?></span>
		<?php endif ?>
	</div>
	<br />
	<div>
		<label>Password: </label><br />
		<input type="password" name="password" value="<?= isset($user['password']) ? $user['password'] : '' ?>">
		<?php if (isset($errors['password'])): ?>
			<span>Error: <?= implode(', ', $errors['password']) ?></span>
		<?php endif ?>
	</div>
	<br />
	<div>
		<label>Password confirm: </label><br />
		<input type="password" name="password_confirm" value="<?= isset($user['password_confirm']) ? $user['password_confirm'] : '' ?>">
		<?php if (isset($errors['password_confirm'])): ?>
			<span>Error: <?= implode(', ', $errors['password_confirm']) ?></span>
		<?php endif ?>
	</div>
	<br />
	<div>
		<button type="submit">Submit</button>
	</div>
	<br />
	<div>
		<a href="/">Home</a> |
		<a href="/login">Login</a>
	</div>
</form>