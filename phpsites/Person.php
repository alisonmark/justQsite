<?php
/**
* 
*/
namespace PersonNameSpace;

class Person
{
	var $name;
	var $age;
	const homeTown = "Hai Duong";
	
	function __construct($name, $age)
	{
		$this->name = $name;
		$this->age = $age;
	}

	public function Speaking()
	{
		echo "Im Speaking";
	}

	public function ShowMe()
	{
		$ht = self::homeTown;
		echo "<br>Im from $ht<br>";
	}
}

class VietNamese extends Person
{
	
}


$arrPeople = array();
$per1 = new Person('QUAN', 30);
$per2 = new Person('HANG', 25);
$arrPeople[] = $per1;
$arrPeople[] = $per2;

// echo (String)$per1;
foreach ($arrPeople as $key => $value) {
	foreach ($value as $k => $val) {
		echo "$k : $val <br/>";
	}
}

$per1->ShowMe();

?>