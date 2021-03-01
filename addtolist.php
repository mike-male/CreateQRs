<?php

$id = $_SESSION["id"];
$username = $_SESSION["username"];

$newurls = null;

if (isset($_POST['addtolist'])) {

	// Check connection
	if ($dbhandle === false) {
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	// Escape user inputs for security
	$url = mysqli_real_escape_string($dbhandle, $_REQUEST['addtolist']);

	$lines = explode(PHP_EOL, $_POST['addtolist']);

	if (!empty($lines)) {
		foreach ($lines as $line) {
			if (!empty($line)) {
				$newurls = $newurls . $line . ",";
			}
		}
		echo "Records added successfully.";
	}

	$sql = "SELECT urls FROM newqrs WHERE username = ('$username')";
	mysqli_query($dbhandle, $sql);

	$result = $dbhandle->query($sql);

	while ($row = $result->fetch_assoc()) {
		$newurls = $row["urls"] . $newurls;
	}

	$sql2 = "UPDATE newqrs SET urls = ('$newurls') WHERE username = ('$username')";

	if (mysqli_query($dbhandle, $sql2)) {
		//echo "Records added successfully.";
	} else {
		echo "ERROR: Could not able to execute $sql2. " . mysqli_error($dbhandle);
	}

	// Close connection
	mysqli_close($dbhandle);
}
