<?php
	require_once("config.php");
	header("Content-Type:application/json");
	$response = array();
	$command = "SELECT CITY,GROUP_CONCAT(DISTINCT MAILCODE) AS MAILCODES,GROUP_CONCAT(DISTINCT COUNTRY) AS COUNTRIES FROM TAIWANSTREETS.TAIWANSTREETS GROUP BY CITY ORDER BY MAILCODE;";

	$response["command"] = $command;
	if($result = $conn->query($command)){
		$rows = array();
		while($row = $result->fetch_assoc()){
			$formatted = array();
			$rCodes = preg_split("/,/", $row["MAILCODES"]);
			$rCountries = preg_split("/,/", $row["COUNTRIES"]);
			// $row["ROADS"] = preg_split("/,/", $row["ROADS"]);

			$formatted["CITY"] = $row["CITY"];
			$formatted["COUNTRIES"] = array();

			for($i=0;$i<count($rCodes);$i++){
				$fCountries = array();
				$fCountries["MAILCODE"] = $rCodes[$i];
				$fCountries["COUNTRY"] = $rCountries[$i];
				
				array_push($formatted["COUNTRIES"], $fCountries);
			}			
			array_push($rows, $formatted);
		}
		$response["result"] = $rows;
		$result->close();
	}else{
		http_response_code(404);
		$response["error"] = $conn->error;
	}
	echo json_encode($response);
?>