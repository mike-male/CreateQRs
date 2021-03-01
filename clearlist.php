<?php
	
	$username = $_SESSION["username"];

	if (isset ($_POST['clearlist'])){
		
		// Check connection
		if ($dbhandle->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT urls FROM newqrs WHERE username = ('$username')";
		$result = $dbhandle->query($sql);
					
			while ($row = $result->fetch_assoc()) {
				$sql = "UPDATE newqrs SET urls = NULL WHERE username = ('$username')";
			}
		
		if ($dbhandle->query($sql) === TRUE) {
			echo "Records deleted successfully";
			} else {
			echo "Error deleting record: " . $dbhandle->error;
		}
		
		$dbhandle->close();
		
		$files = glob('images/' . $username . '/*'); // get all file names
		foreach($files as $file){ // iterate files
			if(is_file($file)) {
				unlink($file); // delete file
			}
		}
		if (file_exists('images/zippedQRs/qrcodes-' . $username . '.zip')) {
		unlink ('images/zippedQRs/qrcodes-' . $username . '.zip');
		}
	}
?>