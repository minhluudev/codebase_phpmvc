<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>
<body>

<form action="/login" method="post">
    <fieldset style="width: fit-content; margin: 0 auto;">
        <legend>Login form:</legend>
        <label for="email">Email:</label><br/>
        <input type="email" name="email" id="email" required/><br/><br/>
        <label for="password">Password:</label><br/>
        <input type="password" name="password" id="password" required/><br/><br/>
        <button type="submit">Login</button>
        <br/>
        <br/>
        <a href="/">Home</a> | <a href="/register">Register</a>
    </fieldset>
</form>

</body>
</html>