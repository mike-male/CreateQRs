<?php

$id = $_SESSION["id"];
$username = $_SESSION["username"];

if (isset($_POST['viewlist'])) {

	// Check connection
	if ($dbhandle->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT urls FROM newqrs WHERE username = ('$username')";
	$result = $dbhandle->query($sql);

	// output data of each row
	echo "<div><table id='viewtable'> <tr> <th>URL</th></tr>";

	echo "<tr><td>&#8226; ";


	while ($row = $result->fetch_assoc()) {

		echo str_replace(",", "<br>&#8226; ", $row["urls"]);
	}

	echo "</tr></td>";

	echo "</table></div>";


	echo "<form method='post'><input type='submit' name='clearlist' id='button' class ='clearbutton' value='Clear List'></form>";


	$dbhandle->close();
}
