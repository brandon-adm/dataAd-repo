<<<<<<< HEAD
<?php
  $dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "client";

	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

	if(!$conn)
	{
		die("Connection Failed. ". mysqli_connect_error());
		echo "can't connect to database";
	}

  function executeQuery($query){
    $conn = $GLOBALS['conn'];
    return mysqli_query($conn, $query);
  }
=======
<?php
  $dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "client";

	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

	if(!$conn)
	{
		die("Connection Failed. ". mysqli_connect_error());
		echo "can't connect to database";
	}

  function executeQuery($query){
    $conn = $GLOBALS['conn'];
    return mysqli_query($conn, $query);
  }
>>>>>>> fb5cd22fcbab5113c719755fb04c3f1e82567ae4
?>