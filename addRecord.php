<?php
    /*declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');*/

    $curYear = date('Y');
    
    require_once('models/Conn.php');
    $name = $_SESSION['name'];
    
    
    if (isset($name)) { 
        $welcomeMessage = "<h1>Add a Record | <a href='account.php'>Home</a></h1>";
    }else { 
        header('Location: login.php');
    }

     function sanitizeInput($value) {
        return htmlspecialchars( stripslashes( trim( $value) ) );
    }     

    
    function insertProjectRecord($conn){
        require_once('models/Conn.php');
        
        $count = 200;
        $count = ++$count;
        $userID =  $_SESSION['name'] + $count;
        $name = $_POST['name'];
        $date = $_POST['date'];
        
        $sql = "
        INSERT INTO project
        (user\$id, name, dueDate)
        VALUES
        ('$userID', '$name', '$date')
        ";
        $result = mysqli_query($conn,$sql);
        
        $last_id = $conn->insert_id;
        
         echo "$result project successfully created!";
        return $last_id;
    }

    function saveProjectRecord($conn){
        require_once('models/Conn.php');
        $projectId = getProjectID($conn);
        if ($projectId == '') {
            // no project yet
            insertProjectRecord($conn);
            header("Location: addConfirm.php?");
        } else {
            echo "</br><h1 style='color:red'>***ERROR: This record already exists***</h1>";
        }
    }

    function getUserID($conn){
       require_once('models/Conn.php');
       
       $name = $_POST['name'];
        $sql = "
        SELECT id
        FROM users
        WHERE name = '$name'
        ";
         $result = mysqli_query($conn,$sql);
         
        if ($result->rowCount() == 1) { 
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return (int)$row->fetch()['id']; }
            
        else { return ''; }
    }

    function getProjectID($conn){
        require_once('models/Conn.php');
        
        $name = $_POST['name'];
        
        $sql = "
        SELECT user\$id
        FROM project
        WHERE name= '$name'
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
            //get form fileds
            $name = sanitizeInput($_POST['name']);
            $date = sanitizeInput($_POST['date']);

            saveProjectRecord($conn);

        } catch(PDOEXCEPTION $e) {
            die( $e->getMessage() );
        }
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Add Project | TaskList</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="site.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>

    <body>
    <body class="Recordbody">
    <div class="w3-panel">
        <header>
            <h2>
                <?php if (isset($name)) { 
                    echo $welcomeMessage;}
                ?>
            </h2>
        </header>
        <div class="Rcontainer">
          <form action="<?php echo $phpScript; ?>" method="POST">
            </br>
            <h2>Add a Project</h2>
            <input type="text" name="name" placeholder = "Project Name" required></br></br>
            <p>Project deadline</p>
            <input type="date" name="date" placeholder="dd-mm-yyyy" value=""
            min="1997-01-01" max="2030-12-31" required></br></br>
            <button class="Rbtn">Submit Project</button>
          </form>
        </div>
    </div>
    </body>
    <style>
    </style>
</html>
