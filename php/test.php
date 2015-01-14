<?php
	require_once("config.php");
	header("Content-Type:application/json");
	$response = array();
	$command = "SELECT CITY,MAILCODE,COUNTRY,GROUP_CONCAT(DISTINCT ROAD) ROADS FROM TAIWANSTREETS.TAIWANSTREETS GROUP BY CITY,COUNTRY ORDER BY MAILCODE;";

	if($result = $conn->query($command)){
		$rows = array();
		while($row = $result->fetch_assoc()){
			$row["ROADS"] = preg_split("/,/", $row["ROADS"]);
			array_push($rows, $row);
		}
		$response["result"] = $rows;
		$result->close();
	}
	echo json_encode($response);
?>