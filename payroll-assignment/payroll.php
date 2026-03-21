 <!DOCTYPE html>
<html>
<head>
    <title>Payroll Calculator</title>
</head>
<body>

<h2>Payroll Calculator</h2>

<form method="post">
    Employee Name: <input type="text" name="name" required><br><br>
    Hours Worked (Weekly): <input type="number" step="0.01" name="hours" required><br><br>
    Hourly Pay Rate: <input type="number" step="0.01" name="rate" required><br><br>
    Federal Tax Rate (%): <input type="number" step="0.01" name="federal" required><br><br>
    State Tax Rate (%): <input type="number" step="0.01" name="state" required><br><br>

    <input type="submit" name="submit" value="Calculate">
</form>

<?php
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $hours = $_POST['hours'];
    $rate = $_POST['rate'];
    $federalRate = $_POST['federal'] / 100;
    $stateRate = $_POST['state'] / 100;

    $grossPay = $hours * $rate;
    $federalWithholding = $grossPay * $federalRate;
    $stateWithholding = $grossPay * $stateRate;
    $totalDeductions = $federalWithholding + $stateWithholding;
    $netPay = $grossPay - $totalDeductions;

    $annualIncome = $grossPay * 52;

    if ($annualIncome <= 11600) {
        $taxBracket = "10%";
    } elseif ($annualIncome <= 47150) {
        $taxBracket = "12%";
    } elseif ($annualIncome <= 100525) {
        $taxBracket = "22%";
    } elseif ($annualIncome <= 191950) {
        $taxBracket = "24%";
    } elseif ($annualIncome <= 243725) {
        $taxBracket = "32%";
    } elseif ($annualIncome <= 609350) {
        $taxBracket = "35%";
    } else {
        $taxBracket = "37%";
    }

    echo "<h3>Payroll Results</h3>";
    echo "<table border='1' cellpadding='5'>";

    echo "<tr><td>Employee Name</td><td>$name</td></tr>";
    echo "<tr><td>Hours Worked</td><td>$hours</td></tr>";
    echo "<tr><td>Pay Rate</td><td>$" . number_format($rate, 2) . "</td></tr>";
    echo "<tr><td>Gross Pay</td><td>$" . number_format($grossPay, 2) . "</td></tr>";
    echo "<tr><td>Federal Withholding</td><td>$" . number_format($federalWithholding, 2) . "</td></tr>";
    echo "<tr><td>State Withholding</td><td>$" . number_format($stateWithholding, 2) . "</td></tr>";
    echo "<tr><td>Total Deductions</td><td>$" . number_format($totalDeductions, 2) . "</td></tr>";
    echo "<tr><td>Net Pay</td><td>$" . number_format($netPay, 2) . "</td></tr>";
    echo "<tr><td>Estimated Annual Income</td><td>$" . number_format($annualIncome, 2) . "</td></tr>";
    echo "<tr><td>2025 Federal Tax Bracket</td><td>$taxBracket</td></tr>";

    echo "</table>";
}
?>

</body>
</html>

