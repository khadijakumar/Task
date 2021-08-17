<?php
    
    /*declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');*/
     session_start();
     
     require_once("models/Conn.php");
     $userName = $_SESSION['name'];
     
     if (isset($userName)) { 
      $sql = "SELECT Access_Code  FROM uc_users WHERE user_name='$userName'";
      $result = mysqli_query($conn,$sql);
      $welcomeMessage;
      if ($result->num_rows == 1) { 
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        if($row['Access_Code'] == 755 && isset($_SESSION['name'])){
            session_start();
            if (isset($userName)) { 
               $welcomeMessage = "<h2>&emsp;&emsp;&emsp;Welcome to admin, $userName.</h2>";
            }
            $_SESSION['name'] = true;
        } else if($row['Access_Code'] == null){
            $_SESSION['isAdmin'] = false;
            header('location:noAccess.php');
        }
      }
     }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin- Task</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="site.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        
    </head>

    <body class="Abody" >
        <!--Welcome message-->
        <div>
            <header class="Aheader">
                <h5 class="Ah5">
                    <?php 
                        echo $welcomeMessage;
                    ?>
                </h5>
                <h5 class = "Ah5">
                    <a class="Aa" href='account.php'>Home</a>&emsp;
                    <a class="Aa" href='addRecord.php'>Add Project</a>&emsp;
                    <a class="Aa" href='addTask.php'>Add Task</a>&emsp;
                    <a class="Aa"  id="myBtn" >Delete Record</a>&emsp;
                    <a class="Aa" href='logout.php'>Logout</a>
                </h5>
            </header>
        </div><br><br><br>
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
          <div class="modal-content">
             <span class="close">&times;</span>
             <div style="margin-left:300px; margin-right:auto; position:absolute">
       
           <form action="deleteRecord.php" method="POST">
               </br>
               <h4>Are you sure you want to delete your project? </h4></br>
               <input type="radio" id="yes" name="answer" value="yes">
               <label for="yes">Yes, I do</label>&emsp;
               <input type="radio" id="no" name="answer" value="no" checked="true">
               <label for="no">No, I don't</label></br><br><br>
               <button class="Rbtn">Delete</button>
           </form>
          </div>
        </div>

        </div>
        <div>
		<table class="table">
			<thead>
				<tr>
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
									'<a class="Aa" href="update_task.php?id='.$fetch['id'].'" class="btn btn-success"><span class="glyphicon glyphicon-check">check</span></a> |';
								}
							?>
							 <a class="Aa" href="delete_query.php?id=<?php echo $fetch['id']?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove">remove</span></a>
						</center>
					</td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
	
	<script>

       var modal = document.getElementById("myModal");

       var btn = document.getElementById("myBtn");

       var span = document.getElementsByClassName("close")[0];


       btn.onclick = function() {
          modal.style.display = "block";
       }

       span.onclick = function() {
          modal.style.display = "none";
       }

       window.onclick = function(event) {
         if (event.target == modal) {
            modal.style.display = "none";
          }
       }
    </script>

    </body>

    <style>
     
</style>
</html>