<?php
	echo "HELLO WORLDDDD";
	// Ví dụ về khai báo biến
	$world = 'Fucking in the sun';
	// $5theEnd = 15
	echo "<br/>";
	echo "Ví dụ về khai báo biến";
	echo $world;

	// Ví dụ về khai báo Hằng số
	echo "<br/>";
	echo "Ví dụ về khai báo Hằng số";
	define('constantVar','This is Untouchable');
	echo constantVar;

	// Ví dụ về khai báo và xử lý với mảng trong PHP
	$arr1 = array('Num1', 'Num2', 'Num3');
	$arr2 = ['Num1', 'Num2', 'Num3'];
	echo "<br/>";
	echo "Ví dụ về khai báo và xử lý với mảng";
	echo "<br/>";
	print_r($arr2);
	echo "<br/>";
	print_r($arr1);
	echo "<br/>";
	echo $arr1[1];

	echo "<br/>";
	echo "Thêm phần tử vào mảng";
	$arr1[] = "Coding";
	$arr2[4] = 'Im Fine';

	echo "<br/>";
	print_r($arr1);
	
	echo "<br/>";
	print_r($arr2);

	echo "<br/>";
	echo $arr2[4];

	echo "<br/>";
	echo "--------------------------------------------";
	echo "<br/>";
	echo "Câu lệnh điều kiện";
	echo "<br/>";

	$age = 45;
	if ($age <= 18) {
		echo "<br/>";
		echo $age." tuổi bạn chưa đủ tuổi vị thành niên";
	}
	elseif ($age > 18 && $age <= 40) {
		echo "<br/>";
		echo $age." tuổi bạn lớn rồi đi kiếm ăn đi";
	}
	else {
		echo "<br/>";
		echo $age." tuổi bạn đã già rồi";
	}

	echo "<br/>";
	echo "--------------------------------------------";
	echo "<br/>";
	echo "Vòng lặp FOR";
	for ($i=0; $i <= 10 ; $i+=2) { 
		echo "<br/>";
		echo "Counting me : ".$i." lalala";
	}

	echo "<br/>";
	echo "--------------------------------------------";
	echo "<br/>";
	echo "Vòng lặp FOREACH";

	$arrStudent = ['A', 'B', 'C', 'D'];
	foreach ($arrStudent as $k => $val) {
		echo "<br/>";
		echo "Counting me : ".$k." with value = ".$val;
	}

	foreach ($arrStudent as $val) {
		echo "<br/>";
		echo "Counting me : ".$val;
	}
?>