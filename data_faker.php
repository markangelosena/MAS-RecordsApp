<?php
	require 'config/config.php';
	require 'config/db.php';
	
	require 'vendor/autoload.php';

	$faker = Faker\Factory::create('en_PH');

	$query_office = "SELECT COUNT(*) as 'count_office' FROM office";
	$query_employee = "SELECT COUNT(*) as 'count_employee' FROM employee";

	//office
	$result_office = mysqli_query($conn, $query_office);
	$total_office  = mysqli_fetch_array($result_office);
	//total office
	$count_office = $total_office['count_office'];
	mysqli_free_result($result_office);

	//employee
	$result_employee = mysqli_query($conn, $query_employee);
	$total_employee  = mysqli_fetch_array($result_employee);
	//total employee
	$count_employee = $total_employee['count_employee'];

	mysqli_free_result($result_employee);

	//action array
	$action_arr = array('IN', 'OUT', 'COMPLETE');

	for($i = 0;$i <= 200; $i++){
		//action
		foreach($action_arr as $key=>$action){
			$randomizer = rand(0,$key);
			$actions = $action_arr[$randomizer];
		}

		//remarks
		$remarks = $faker->sentence(3);

		//documentcode
		$document_code = $faker->randomNumber(3);
		
		//office and employee
		$countEmployee = rand(0,$count_employee);
		$countOffice = rand(0,$count_office);

		$query_insert = "INSERT INTO transaction(employee_id, office_id, action, remarks, documentcode) values($countEmployee, $countOffice, '$actions', '$remarks', '$document_code')";

		if(mysqli_query($conn,$query_insert)){
		}else{
			echo 'ERROR: '. mysqli_error($conn);
		}
	}

	mysqli_close($conn);


?>
