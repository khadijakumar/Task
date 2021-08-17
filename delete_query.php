<?php
	require_once('models/Conn.php');
	
	if($_GET['id']){
		$task_id = $_GET['id'];
		
		$conn->query("DELETE FROM `task` WHERE `id` = $task_id") or die(mysqli_errno());
		header("location: adminPortal.php");
	}	
?>