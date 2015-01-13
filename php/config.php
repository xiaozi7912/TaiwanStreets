<?php
	$host = "localhost";
	$user = "demo";
	$pwd = "demo";
	$database = "taiwanstreets";
	$conn = new mysqli($host,$user,$pwd,$database);
	$response = array();

	if($conn->connect_errno){
		array_push($response, $conn->connect_error);
	}

	echo json_encode($response);
?>