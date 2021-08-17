<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("models/Conn.php");
function load($page= 'login.php'){
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url, '^/');
    $url .= '/'.$page;
    
    //load function block and and insert statement to load specified page
    header("Location:$url");
    exit();
    }
    // function to validate the user login details
    function validate($conn, $username = '', $password = ''){
        $errors = array();
        
        // store username and send error message if not the case
        if( empty($username)){
            $errors[] = 'Please enter your username';
        }
        else{
            $e = mysqli_real_escape_string($conn,trim($username));
        }
        
        //now lets do the same for the password
        if( empty($password)){
            $errors[] = 'Please enter your password';
        }
        else{
            $e = mysqli_real_escape_string($conn,trim($password));
        }
        
        
        // now we validate if the user is existing in the database while using unprepared staments.
        if( empty($errors)){
            $q = "SELECT  id,name FROM `uc_my_users` WHERE username = '$e' AND password = SHA2('$password', 256)";
            $result = mysqli_query($conn,$q);
            
            //validate query
            if( mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                return array(true,$row);
            }
            else{
                $errors[] = 'Username and password not found';
            }
        }
       
    
     return array(false,$errors);
    }
?>