<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/


require_once("models/Conn.php");
 
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $accessCode;
    if(isset($_POST['admin'])){
        $accessCode = '755';
    }
    if(isset($_POST['mod'])){
        $accessCode = '300';
    }
    
 
    
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } 
    
     else{
       
        $sql = "SELECT id FROM uc_users WHERE user_name = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
           
            $param_username = trim($_POST["username"]);
            
            
            if(mysqli_stmt_execute($stmt)){
               
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

           
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        
        $sql = "INSERT INTO uc_users (user_name, password, Access_Code) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password,$param_access);
            
           
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_access = $accessCode;
           
            if(mysqli_stmt_execute($stmt)){
              
                header("location: account.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
   
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
     /*sighnup page css*/
        body{ 
      overflow: hidden;
      margin: 0px;
      background-image: url("pexels-cottonbro-4629633.jpg");
      height:100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      font: 12px sans-serif; }
        
        .container {
      width: 25.625rem;
      height: auto;
      display: block;
      margin-left: 31.25rem;
      margin-right: auto;
      margin-top: 5rem;
      margin-bottom: auto;
      box-sizing: border-box;
      border-color: gray;
      border-style: solid;
      border-radius: 2%;
      text-align: center;
      font-weight:56.25rem;
    }
    .btn{
       background-color: #FF8C00;
       border: none;
       color: white;
       padding: 0.625rem 0.75rem;
       text-align: center;
       text-decoration: none;
       display: inline-block;
       font-size: 16px;
    }
    </style>
</head>
<body>
    <div class="container">
     <div class="wrapper">
        <h2>Sign Up</h2>
        <p style=" color:whitesmoke;">Please fill this form to create a login account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label style="font-weight:900; color:whitesmoke;">Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label style="font-weight:900;color:whitesmoke;">Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label style="font-weight:900;color:whitesmoke;">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <input type="checkbox" id="admin" name="admin" value="Bike">
            <label for="admin" style="font-weight:900;color:whitesmoke;"> Admin</label><br>
            <input type="checkbox" id="mod" name="mod" value="Bike">
            <label for="mod" style="font-weight:900;color:whitesmoke;"> Moderator</label><br>
            <div class="btn">
                <input type="submit" class="btn btn-secondary ml-2" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div><br><br>
            <p>Go back to <a style="color:orange;"href="login.php">Login</a>.page</p>
        </form>
    </div> 
  </div>
</body>
</html>