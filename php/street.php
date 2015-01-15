<?php
	require_once("config.php");
	header("Content-Type:application/json");
	$city = $_GET["city"];
	$country = $_GET["country"];
	$response = array();
	$command = sprintf("SELECT MAILCODE,GROUP_CONCAT(DISTINCT ROAD) AS ROADS FROM TAIWANSTREETS.TAIWANSTREETS WHERE CITY='%s' AND COUNTRY='%s' GROUP BY MAILCODE ORDER BY MAILCODE;",$city,$country);

	// $response["command"] = $command;
	if($result = $conn->query($command)){
		$rows = array();
		while($row = $result->fetch_assoc()){
			$row["ROADS"] = preg_split("/,/", $row["ROADS"]);
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