<?php
	/* CC3206 Programming Project
	Lecture Class: 203
	Lecturer: Dr Simon WONG
	Group Member: CHAN You Zhi Eugene (11036677A)
	Group Member: FONG Chi Fai (11058147A)
	Group Member: SO Chun Kit (11048455A)
	Group Member: SO Tik Hang (111030753A)
	Group Member: WONG Ka Wai (11038591A)
	Group Member: YEUNG Chi Shing (11062622A) */
	
	// read JSon input
	$obj = json_decode(file_get_contents('php://input'));
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
	header('Access-Control-Allow-Headers: Content-Type');
	$player = $obj->player;
	$message = $obj->message;
	
	// Connect to MySQL
	if (!($database = mysql_pconnect("localhost", "root", "")))
		echo "Could not connect to database!";
	
	// Open game database
	if (!mysql_select_db("zeropollution", $database))
		echo "Could not open game database!";
	
	if ($message != "") {
		$query = "INSERT INTO chatroom(player_id, message) VALUES('".$player."', '".$message."')";
		
		// Query game database
		if (!($result = mysql_query($query, $database)))
			echo "Could not execute action!";
	}
	
	$query = "SELECT * FROM chatroom";
	
	// Query game database
	if (!($result = mysql_query($query, $database)))
		echo "Could not execute action!";
	
	while ($record = mysql_fetch_assoc($result)) {
		$row[] = $record;
	}
	
	if (sizeof($row) > 1000) {
		$query = "DELETE FROM chatroom where record_id <= 1000";
		
		// Query game database
		if (!($result = mysql_query($query, $database)))
			echo "Could not execute action!";
	}
	
	mysql_close($database);
?>