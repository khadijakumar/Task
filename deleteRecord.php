<?php

    /*declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');*/

     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    $userName = $_SESSION['name'];

    function sanitizeInput($value) {
        return htmlspecialchars( stripslashes( trim( $value) ) );
    } 

    function deleteProjectRecord($conn) {
        require_once('models/Conn.php');
        $userID = getUserID($conn);

        $sql = "
        DELETE FROM project
        WHERE user\$id = '$userID';
        ";
        
        $result = mysqli_query($conn,$sql);
        
        $last_id = $conn->insert_id;
        return $last_id;
    }

    function deleteProjectTasks($conn) {
        require_once('models/Conn.php');
        $projectID = getProjectID($conn);

        // Notice the single quotes around the name.
        $sql = "
        DELETE FROM task
        WHERE project\$id = '$projectID';
        ";
        
        $result = mysqli_query($conn,$sql);
    }

    function getUserID($conn){
        require_once('models/Conn.php');
        $userName = $_SESSION['name'];
        $sql = "
        SELECT id
        FROM uc_users
        WHERE user_name = '$userName'";
        $result = mysqli_query($conn,$sql);
         
        if ($result->num_rows == 1) { 
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return (int)$row->fetch()['id']; }
            
        else { return ''; }
    }

    function getProjectID($conn){
        require_once('models/Conn.php');
        $userID = getUserID($conn);
        

        $sql = "
        SELECT id
        FROM project
        WHERE user\$id= '$userID'
        ";
        $result = mysqli_query($conn,$sql);
        if ($result->num_rows == 1) { 
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return (int)$row->fetch()['user\$id']; }
            
        else { return ''; }
    }
    
    

    $phpScript = sanitizeInput($_SERVER['PHP_SELF']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            
            require_once('models/Conn.php');
            

            // Extract the fields.
            $answer = $_POST['answer'];
            if($answer == "yes"){
                deleteProjectTasks($conn);
                sleep(rand(2,3));
                deleteProjectRecord($conn);
                
                echo'<p>Records successfully deleted return <a href="adminPortal.php">Back</a></p>';
                
            }
          
        } catch(PDOEXCEPTION $e) {
            
            die( $e->getMessage() );
        }
        
    }

?>
