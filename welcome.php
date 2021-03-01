<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require "mydatabase.php";
require "dbconnect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <div class="mainsection">
        <div class="welcome-row">
            <div class="page-header-column">
                <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to CreateQRs.com</h1>
            </div>
            <div class="sign-out-column">
                <a href="logout.php" class="btn-signout">Sign Out</a>
            </div>
        </div>


        <div class="instructions-row">
            <div class="instruct1">
                <img src="icons/type.png" style="width: 50px; padding-top: 35px;" />
                <p id="instruction-content"><b>Step 1.</b><br><br>Enter text in the box below. To create multiple QR codes, enter text on separate lines.</p>
            </div>

            <div class="instruct2">
                <img src="icons/click.png" style="width: 50px; padding-top: 35px;" />
                <p id="instruction-content"><b>Step 2.</b><br><br>Click the <b>Add</b> button to add the URLs to your list. You can add more to your list if needed.</p>
            </div>

            <div class="instruct3">
                <img src="icons/convert.png" style="width: 50px; padding-top: 35px;" />
                <p id="instruction-content"><b>Step 3.</b><br><br>Click the <b>Generate QR Codes</b> button to convert all of the URLs on your list into QR codes.</p>
            </div>
            <div class="instruct4">
                <img src="icons/download.png" style="width: 50px; padding-top: 35px;" />
                <p id="instruction-content"><b>Step 4.</b><br><br>Download all of your generated QR codes by clicking the <b>Download QR Codes</b> button.</p>
            </div>
        </div>

        <form method="post" id="add">
            <textarea name="addtolist" rows="4" cols="115" style="width: 80%"></textarea>
            <p style="padding: 0 25px 0 25px"><i><b>Note: if any lines contain more than 250 characters, they will be trimmed to 250 before the QR code is generated.</b></i></p>
            <div class="form-group">
                <input type="submit" name="add" value="Add" class="btn btn-add" />
            </div>
        </form>


        <div class="row">
            <div class="column1">
                <form method="post">
                    <button name="viewlist" class="btn btn-row">View QR List</button>
                </form>
            </div>

            <div class="column2">
                <form method="post">
                    <input type="submit" name="generate" value="Generate QR Codes" class="btn btn-row" onclick="generate()">
                </form>
            </div>

            <div class="column3">
                <form method="post">
                    <input type="submit" name="download" value="Download QR Codes" class="btn btn-row" onclick="download()">
                </form>
            </div>
        </div>

        <?php
        require "viewlist.php";
        require "clearlist.php";
        require "addtolist.php";
        require "generate.php";
        require "download.php";
        ?>
    </div>
</body>

</html>