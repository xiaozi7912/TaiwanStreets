<?php
	require_once("config.php");
	header("Content-Type:application/json");
	$response = array();
	$command = "SELECT CITY FROM TAIWANSTREETS.TAIWANSTREETS GROUP BY CITY ORDER BY MAILCODE;";

	// $response["command"] = $command;
	if($result = $conn->query($command)){
		$rows = array();
		while($row = $result->fetch_assoc()){			
			array_push($rows, $row["CITY"]);
		}
		$response["result"] = $rows;
		$result->close();
	}else{
		http_response_code(404);
		$response["error"] = $conn->error;
	}
	echo json_encode($response);
?>