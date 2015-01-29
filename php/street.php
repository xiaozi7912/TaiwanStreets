<?php
	require_once("config.php");
	header("Content-Type:application/json");
	$city = $_GET["city"];
	$country = $_GET["country"];
	$response = array();
	$command = sprintf("SELECT MAILCODE,ROAD FROM TAIWANSTREETS.TAIWANSTREETS WHERE CITY='%s' AND COUNTRY='%s' ORDER BY MAILCODE;",$city,$country);

	// $response["command"] = $command;
	if($result = $conn->query($command)){
		$rows = array();
		while($row = $result->fetch_assoc()){
			array_push($rows, $row);
		}
		$response["result"] = $rows;
		$result->close();
	}else{
		http_response_code(404);
		$response["error"] = $conn->error;
	}
	echo json_encode($response);
?>