<h1>Birthday Formatter</h1>

<?php
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $month  = htmlspecialchars($_POST["month"]);
    $day    = (int) $_POST["day"];
    $year   = (int) $_POST["year"];
    $hour   = (int) $_POST["hour"];
    $minute = (int) $_POST["minute"];
    $ampm   = htmlspecialchars($_POST["ampm"]);
    if($ampm === "PM"){
        $hour+=12;
    }
    $timestamp = mktime($hour, $minute, 0, $month, $day, $year);
    if(checkdate($month, $day, $year) != true){
        echo "Invalid date";
        exit();
    }
    $formatted = date("l F jS, Y - g:ia", $timestamp);

    $query = "chs1Test.php?month=$month&day=$day&year=$year&hour=" . ($_POST["hour"]) . "&minute=$minute&ampm=$ampm";

    echo $formatted;
    echo "<br><br>";
    echo "<a href='$query'>Convert to ISO format</a>";

    exit();
    }

if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["month"])) {
    $month  = htmlspecialchars($_GET["month"]);
    $day    = (int) $_GET["day"];
    $year   = (int) $_GET["year"];
    $hour   = (int) $_GET["hour"];
    $minute = (int) $_GET["minute"];
    $ampm   = htmlspecialchars($_GET["ampm"]);

    if($ampm === "PM" && $hour != 12){
        $hour += 12;
    }
    if($ampm === "AM" && $hour == 12){
        $hour = 0;
    }

    if(!checkdate($month, $day, $year)){
        echo "Invalid date";
        exit();
    }

    $timestamp = mktime($hour, $minute, 0, $month, $day, $year);

    echo date("Y-m-d H:i:s", $timestamp);
    exit();
}

?>
<table border="1">
    <tr>
        <th>Month</th>
        <th>Day</th>
        <th>Year</th>
        <th>Hour</th>
        <th>Minute</th>
        <th>AM/PM</th>
    </tr>

    <form action="chs1Test.php" method="post">
        <tr>
            <td>
                <select name="month">
                    <?php
                    $months = array( 
                    "01" => "January",
                    "02" => "February", 
                    "03" => "March",
                    "04" => "April",   
                    "05" => "May",      
                    "06" => "June",
                    "07" => "July",    
                    "08" => "August",   
                    "09" => "September",
                    "10" => "October", 
                    "11" => "November", 
                    "12" => "December"
                    );
                    foreach ($months as $num => $name) {
                    echo "<option value='$num'>$name</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <select name="day">
                    <?php
                    $day = 1;

                    do {
                        echo "<option value='$day'>$day</option>";
                        $day++;
                    } while ($day <= 31);
                    ?>
                </select>
            </td>
            <td>
                <select name="year">
                    <?php
                    $year = 1900;

                    do {
                        echo "<option value='$year'>$year</option>";
                        $year++;
                    } while ($year <= 2026);
                    ?>
                </select>
            </td>
            <td>
                <select name="hour">
                    <?php
                    $hour = 1;

                    do {
                        echo "<option value='$hour'>$hour</option>";
                        $hour++;
                    } while ($hour <= 12);
                    ?>
                </select>
            </td>
            <td>
                <select name="minute">
                    <?php
                    $minute = 0;

                    do {
                        echo "<option value='$minute'>$minute</option>";
                        $minute++;
                    } while ($minute <= 59);
                    ?>
                </select>
            </td>
            <td>
                <select name="ampm">
                    <option>AM</option>
                    <option>PM</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center;">
                <button type="submit">Format Date</button>
             </td>
        </tr>

    </form>


</table>
