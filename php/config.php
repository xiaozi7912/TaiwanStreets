<?php	
	$host = "localhost";
	$user = "demo";
	$pwd = "demo";
	$database = "taiwanstreets";
	$conn = new mysqli($host,$user,$pwd,$database);
	$response = array();

	if($conn->connect_errno){
		$response["error"] = $conn->connect_error;
		echo json_encode($response);
	}
	$conn->query("SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;");
?>