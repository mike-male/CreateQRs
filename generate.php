<?php

$username = $_SESSION["username"];

if (isset($_POST['generate'])) {
	echo "<table id='gentable'> <tr> <th id='gentable-url'>QR Content</th> <th id ='gentable-qrcode'>QR Code</th></tr>";

	include('phpqrcode/qrlib.php');

	// how to save PNG codes to server

	if (!file_exists('images/' . $username)) {
		mkdir('images/' . $username, 0777, true);
	}

	$tempDir = "images/" . $username . "/";


	// Check connection
	if ($dbhandle->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT urls FROM newqrs WHERE username = ('$username')";
	$result = $dbhandle->query($sql);

	while ($row = $result->fetch_assoc()) {
		$newrow = implode("|", $row);
		$qrs_array = explode(',', $newrow);
		foreach ($qrs_array as $value) {

			if (strlen($value) > 250) {
				$value = substr($value, 0, 250);
			}

			if (!empty($value)) {

				$cleanvalue = $value;
				$cleanvalue = preg_replace("/[^a-zA-Z 0-9]+/", "", $cleanvalue);
				$fileName = ($cleanvalue) . '.png';

				$pngAbsoluteFilePath = $tempDir . $fileName;
				$urlRelativeFilePath = $tempDir . $fileName;

				$urlname = $value;

				if (!file_exists($pngAbsoluteFilePath)) {
					QRcode::png($urlname, $pngAbsoluteFilePath);
				}
				echo "<tr><td>" . $urlname . "</td> <td>" . '<img src="' . $urlRelativeFilePath . '" />' . "</td></tr>";
			}
		}
		echo "</table>";
		$dbhandle->close();
	}
}
