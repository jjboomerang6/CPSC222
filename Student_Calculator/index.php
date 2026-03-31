 <?php

require_once("Student.php");
require_once("Grades.php");

$students = array(
    new Student("Kevin", "Slonka", "1001", array("CPSC222" => 98, "CPSC111" => 76, "CPSC333" => 82)),
    new Student("Jack", "Julin", "1002", array("CPSC222" => 88, "CPSC111" => 46, "CPSC333" => 72)),
    new Student("Stewie", "Griffin", "1003", array("CPSC222" => 68, "CPSC111" => 96, "CPSC333" => 82))
);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Grades</title>
</head>
<body>

<h1>Grades</h1>

<?php
	for ($i = 0; $i < count($students); $i++) {

  
echo "<table border=1>";
   
   	echo "<tr>";
	echo "<th>Name</th>";
    	echo "<td>" . $students[$i]->getLastName() . ", " . $students[$i]->getFirstName() . "</td>";
    	echo "</tr>";

    echo "<tr>";
    echo "<th>Student ID</th>";
    echo "<td>" . $students[$i]->getStudentId() . "</td>";
    echo "</tr>";

   	echo "<tr>";
    	echo "<th>Grades</th>";
    	echo "<td><ul>";

    foreach ($students[$i]->getCourses() as $course => $grade)
	{
	echo "<li>$course - $grade" . "% " . getGrade($grade) . "</li>";
    	}

    	echo "</ul></td>";
    	echo "</tr>";

    	echo "</table><br>";
}
?>

	</body>
</html>
