<?php
session_start();

function cleanInput($name) {
    $name = preg_replace("/[^a-zA-Z0-9_\-\s]/", "", $name);
    return trim($name);
}

$error = "";

if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: ch13.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = cleanInput($_POST["username"] ?? "");
    $password = cleanInput($_POST["password"] ?? "");

    if ($username === "admin" && $password === "password") {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
    } else {
        $error = "Invalid login...";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chapter 13 Login</title>
</head>
<body>

<?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
    <h1>Hello, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
    <p><a href="ch13.php?logout=true">Logout</a></p>

<?php else: ?>
    <?php if ($error !== ""): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="ch13.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br><br>

        <input type="submit" value="Login">
    </form>
<?php endif; ?>

</body>
</html>
