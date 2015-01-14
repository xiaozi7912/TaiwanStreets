<?php
	require_once("config.php");
	header("Content-Type:application/json");
	$city = $_GET["city"];
	$response = array();
	$command = sprintf("SELECT COUNTRY,MAILCODE,GROUP_CONCAT(DISTINCT ROAD) AS ROADS FROM TAIWANSTREETS.TAIWANSTREETS WHERE CITY='%s' GROUP BY COUNTRY ORDER BY MAILCODE;",$city);

	// $response["command"] = $command;
	$conn->query("SET SESSION GROUP_CONCAT_MAX_LEN = 1000000;");
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