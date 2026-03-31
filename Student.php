<?php

class student
	{
	private $firstName = '', $lastName = '', $studentID = '', $courses = array();

	function __construct($Fn, $Ln, $ID, $C)
		{
		$this -> setFirstName($Fn);
		$this -> setLastName($Ln);
		$this -> setStudentId($ID);
		$this -> setCourses($C);
		}

	function setFirstName($Fn)
		{$this -> firstName = $Fn;}

	function setLastName($Ln)
		{$this -> lastName = $Ln;}

	function setStudentId($ID)
		{$this -> studentId = $ID;}

	function setCourses($C)
		{$this -> courses = $C;}



	function getFirstName()
		{return $this -> firstName;}

	function getLastName()
		{return $this -> lastName;}

	function getStudentId()
		{return $this -> studentId;}

	function getCourses()
		{return $this -> courses;}
	}
?>
