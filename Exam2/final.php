 <?php
session_start();

function pageHeader() {
    echo "<h1>CPSC222 Final Exam</h1>";
}

function pageFooter() {
    echo "<hr>";
    echo date("Y-m-d h:i:s A");
}

function checkLogin($username, $password) {
    $lines = file("auth.db", FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        $parts = explode("\t", $line);

        if (count($parts) == 2) {
            if ($parts[0] == $username && $parts[1] == $password) {
                return true;
            }
        }
    }

    return false;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (checkLogin($username, $password)) {
        $_SESSION["username"] = $username;
        header("Location: final.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}

pageHeader();

if (!isset($_SESSION["username"])) {
    if ($error != "") {
        echo "<p>$error</p>";
    }

    echo '
    <form method="post" action="final.php">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
    ';

    pageFooter();
    exit();
}

$username = $_SESSION["username"];

echo "<p><b>Welcome, $username!</b> (<a href='final_logout.php'>Log Out</a>)</p>";

if (!isset($_GET["page"])) {
    echo "<p>Dashboard:</p>";
    echo "<ul>";
    echo "<li><a href='final.php?page=1'>User list</a></li>";
    echo "<li><a href='final.php?page=2'>Group list</a></li>";
    echo "<li><a href='final.php?page=3'>Syslog</a></li>";
    echo "</ul>";

    pageFooter();
    exit();
}

echo "<p><a href='final.php'>&lt; Back to Dashboard</a></p>";

$page = $_GET["page"];

if ($page == "1") {
    echo "<h3>User list</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Username</th><th>Password</th><th>UID</th><th>GID</th><th>Display Name</th><th>Home Directory</th><th>Default Shell</th></tr>";

    $lines = file("/etc/passwd", FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        $parts = explode(":", $line);

        echo "<tr>";
        foreach ($parts as $part) {
            echo "<td>" . htmlspecialchars($part) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";

} elseif ($page == "2") {
    echo "<h3>Group list</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Group Name</th><th>Password</th><th>GID</th><th>Members</th></tr>";

    $lines = file("/etc/group", FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        $parts = explode(":", $line);

        echo "<tr>";
        foreach ($parts as $part) {
            echo "<td>" . htmlspecialchars($part) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";

} elseif ($page == "3") {
    echo "<h3>Syslog</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Date</th><th>Hostname</th><th>Application[PID]</th><th>Message</th></tr>";

    $lines = file("/var/log/syslog", FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        $parts = explode(" ", $line, 3);

        echo "<tr>";

        if (count($parts) == 3) {
            $date = $parts[0];
            $host = $parts[1];
            $rest = $parts[2];

            $appParts = explode(":", $rest, 2);

            $app = $appParts[0];
            $message = "";

            if (isset($appParts[1])) {
                $message = $appParts[1];
            }

            echo "<td>" . htmlspecialchars($date) . "</td>";
            echo "<td>" . htmlspecialchars($host) . "</td>";
            echo "<td>" . htmlspecialchars($app) . "</td>";
            echo "<td>" . htmlspecialchars($message) . "</td>";
        } else {
            echo "<td colspan='4'>" . htmlspecialchars($line) . "</td>";
        }

        echo "</tr>";
    }

    echo "</table>";

} else {
    echo "<p>Invalid page</p>";
}

pageFooter();
?>
