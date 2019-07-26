<?php
	 $con = mysqli_connect('localhost','root','','gitrepo');

	 if (isset($_GET['rid'])) {
	 	$rid = $_GET['rid'];
	 	$data = "SELECT * FROM repo WHERE repo_id=$rid";
	 	$ExecQuery = MySQLi_query($con, $data);
	 	$Result = MySQLi_fetch_array($ExecQuery);

	 	$dat = $Result['repo_id'];
	 	$dat2 = $Result['name'];


	 	echo "Repo ID: $dat <br>";
	 	echo "Repo Name: $dat2";

	 }
?>