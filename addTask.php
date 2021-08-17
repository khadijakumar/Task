<?php

    /*declare(strict_types = 1);
    error_reporting(E_ALL);
    ini_set('display_errors', '1');*/

    $curYear = date('Y');
    
    require_once('models/Conn.php');
    $userName = $_SESSION['name'];
    if (isset($userName)) { 
        $welcomeMessage = "<h1>Add a Task | <a href='account.php'>Home</a></h1>";
    }else { 
        header('Location: login.php');
    }

  
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Add Task </title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="site.css">
        <!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
    </head>

  
    <body class="Tbody">
    <div class="w3-panel">
        <header>
            <h2>
                <?php 
                    echo $welcomeMessage;
                ?>
            </h2>
        </header>
        <div class="Tcontainer">
          <form action="add_query.php" method="POST">
            </br>
            <h2>Add a Task</h2>
            <input type="text" name="task" placeholder = "Task Name" required></br>
            
             <h2>Project</h2>
             <input id="user" placeholder="Add task project" type="text" name="project" style="width:160px">
            
            <p>Is this task completed?</p>
            <input type="radio" id="yes" name="status" value="Y">
            <label for="yes">Yes (Y)</label>&emsp;
            <input type="radio" id="no" name="status" value="N" checked="true">
            <label for="yes">No (N)</label></br><br><br>
            
            <button name="add" class="Tbtn">Submit Task</button>
          </form>
        </div>
       </div>
       <?php
    require_once("models/Conn.php");
    $query = "Select name from project";
    $result = mysqli_query($conn,$query);
    $words= "";
    while($row = mysqli_fetch_assoc($result)){
        $words .=  '"'. $row['name'] .'",';
    }
    $cut_words = substr($words, 0, -1);
    echo '<script>
    
    $(document).ready(function () {
    $(document).tooltip();
    var langs = ['.$cut_words.'];
    $("#user").autocomplete({
        source: langs
    });
    window.search = function () {
        var a = document.getElementById("user").value;
        confirm("You tried to search " + a + "!");
    };
    });
    
    </script>';?>
    </body>
    
    <style>
    </style>
</html>
