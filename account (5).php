<?php

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link rel="stylesheet" href="site.css">
	
		
	<style>
	</style>
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>TASK</h1>
				<a href="adminPortal.php">Admin Portal</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"></i>Logout</a>
				
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
            <header id=header class="w3-container w3-center w3-text-gray">
                <h5>
                    <a href='addTask.php'>Add  a task</a>&emsp;
                </h5>
            </header>
		</div>
		<hr style="border-top:1px dotted #ccc;"/>
		<table class="table">
			<thead>
				<tr style="margin-left:0px">
					<th>#</th>
					<th>Task</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require_once("models/Conn.php");
					$query = $conn->query("SELECT * FROM `task` ORDER BY `id` ASC");
					$count = 1;
					while($fetch = $query->fetch_array()){
				?>
				<tr>
					<td><?php echo $count++?></td>
					<td><?php echo $fetch['name']?></td>
					<td><?php echo $fetch['status']?></td>
					<td colspan="2">
						<center>
							<?php
								if($fetch['status'] != "Done"){
									echo 
									'<a href="update_task.php?id='.$fetch['id'].'" class="btn btn-success"><span class="glyphicon glyphicon-check">check</span></a> |';
								}
							?>
						</center>
					</td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>

	</body>
</html>
