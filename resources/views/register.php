<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
</head>
<body>

<form action="/register" method="post">
    <fieldset style="width: fit-content; margin: 0 auto;">
        <legend>Register form:</legend>
        <label for="full_name">Full name:</label><br/>
        <input type="text" name="full_name" id="full_name" required/><br/><br/>

        <label for="email">Email:</label><br/>
        <input type="email" name="email" id="email" required/><br/><br/>

        <label for="password">Password:</label><br/>
        <input type="password" name="password" id="password" required/><br/><br/>

        <label for="password_confirm">Password confirm:</label><br/>
        <input type="password" name="password_confirm" id="password_confirm" required/><br/><br/>

        <button type="submit">Login</button>
        <br/>
        <br/>
        <a href="/">Home</a> | <a href="/login">Login</a>
    </fieldset>
</form>

</body>
</html>