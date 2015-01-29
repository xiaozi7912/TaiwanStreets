<?php
	require_once("config.php");
	header("Content-Type:application/json");
	$response = array();
	$command = "SELECT CITY,GROUP_CONCAT(DISTINCT COUNTRY) AS COUNTRIES FROM TAIWANSTREETS.TAIWANSTREETS GROUP BY CITY ORDER BY MAILCODE;";

	// $response["command"] = $command;
	if($result = $conn->query($command)){
		$rows = array();
		while($row = $result->fetch_assoc()){
			$row["COUNTRIES"] = preg_split("/,/", $row["COUNTRIES"]);
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