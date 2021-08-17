<?php
    $curYear = date('Y');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Record </title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        

    </head>
    <nav class="navtop">
			<div>
				<h1>Tasko</h1>
				<a href="admin.php.php"><i class="fas fa-sign-out-alt"></i>Admin Portal</a>
				<a href="mod.php"><i class="fas fa-sign-out-alt"></i>Moderator Portal</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
				
			</div>
		</nav>
    <body>
        </br></br></br></br></br></br><h1>&emsp;Record added successfully! <a href='addTask.php'>Add Task</a>&emsp;</h1>
    </body>
    <style>
        body{
                background-color: #fcf3cf; 
        }
        
        header{
            display: block;
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100px;
            background-color: #f9e79f;
        }
        	    .navtop {
	background-color: orange;
	height: 60px;
	width: 100%;
	border: 0;
}
.navtop div {
	display: flex;
	margin: 0 auto;
	width: 1000px;
	height: 100%;
}
.navtop div h1, .navtop div a {
	display: inline-flex;
	align-items: center;
}
.navtop div h1 {
	flex: 1;
	font-size: 24px;
	padding: 0;
	margin: 0;
	color: #eaebed;
	font-weight: normal;
}
.navtop div a {
	padding: 0 20px;
	text-decoration: none;
	color: #c1c4c8;
	font-weight: bold;
}
.navtop div a i {
	padding: 2px 8px 0 0;
}
.navtop div a:hover {
	color: #eaebed;
}
    </style>
</html>