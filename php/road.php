<?php
	require_once("config.php");
	header("Content-Type:application/json");
	$mailcode = $_GET["mailcode"];
	$response = array();
	$command = sprintf("SELECT ROAD FROM TAIWANSTREETS.TAIWANSTREETS WHERE MAILCODE=%s;",$mailcode);

	$response["command"] = $command;
	if($result = $conn->query($command)){
		$rows = array();
		while($row = $result->fetch_assoc()){
			array_push($rows, $row["ROAD"]);
		}
		$response["result"] = $rows;
		$result->close();
	}else{
		http_response_code(404);
		$response["error"] = $conn->error;
	}
	echo json_encode($response);
?>