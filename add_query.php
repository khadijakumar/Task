<?php

    declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

	require_once('models/Conn.php');
	if(isset($_POST['add'])){
		if(isset($_POST['task'])){
			$task = $_POST['task'];
			$project = $_POST['project'];
			$progress;
			
        	function getProjectID($conn){
              require_once('models/Conn.php');
        
              $project = $_POST['project'];
        
              $sql = "SELECT user\$id FROM project WHERE name= '$project' ";
        
              $result = mysqli_query($conn,$sql);
              if ($result->num_rows == 1) { 
               $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
               return $row['user$id']; 
              }
               else { return '<h1>***Function Error***</h1>'; }
            }
            
            if($_POST['status'] === 'Y'){
                $progress = 'complete';
            }
            if($_POST['status'] === 'N'){
                $progress = 'pending';
            }
            
            $projectId = getProjectID($conn);		
			
	        $query = "INSERT INTO `task` VALUES(9,'$projectId', '$task', '$progress')";
	           
	         if(mysqli_query($conn,$query)){
                
            }
            else{
                echo "Failed to Insert into uc_stock_allocate ". mysqli_error($conn);
            }
        
	        header('location:account.php');
	   	}else{
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
           
	    }
	}
	
?>