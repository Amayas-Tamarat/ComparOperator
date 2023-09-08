<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
</head>

<body>
    <h1>Admin Login</h1>
    <form method="POST" action="admin.php"> <!-- Point the form to your admin.php script -->
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>
