<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
 
 
  <style>
   /*login page styles*/
    html, body, .main-container {
      height: 100%;
    }

    body {
      font: 12px sans-serif;
      overflow: hidden;
      margin: 0px;
      background-image: url("pexels-nataliya-vaitkevich-6120249.jpg");
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
  
   
    .main-container {
      display: flex;
    }
  
    .split-left, .split-right {
    display: flex;
    flex-direction: column;
    justify-content: center;
    }
  
    .split-left {
      background-size: cover;
      background-position: center;
      flex: 1;
      padding: 1rem;
      transition: all .2s ease-in-out;
    }
  
    .split-right {
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      flex: 1;
      padding: 1rem;
    }
  
    .container {
      width: 20rem;
      height: auto;
      display: block;
      margin-left: 31.25rem;
      margin-right: auto;
      margin-top: auto;
      margin-bottom: auto;
      box-sizing: border-box;
      border-color: gray;
      border-style: solid;
      border-radius: 2%;
    }
  
    .wrapper1 {
      margin: 5.625rem 1.563rem 1.563rem 1.563rem;
      grid-template-columns: repeat(2, 1fr);
      padding-bottom: 0.938rem;
      margin-top:1.25rem;
    }
    
    .LoginInputs {
      width: 15.625rem;
      height: 1.625rem;
    }
  

    a {
      font-size: 14px;
    }

  
    .signup{
     color:#2daad6;
     text-decoration: none;
     margin-left: 0.625rem;
     } 
  
    .loginBtn {
      border: none;
      outline: none;
      height: 2.188rem;
      width: 11.25rem;
      border-radius: 15px;
      background: orange;
      color: white;
      font-size: 12px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
    
  
   
  </style>
 </head>
 <body>
		 <!--Control the left side -->
  <div class="main-container">
    <div class="split-left">
      <div>
        <div class="container">
          <div class="wrapper1">
              <h2>Login to TASK</h2>
            <form action="login1.php" method="post">
              <div class="box1"><br>
                <p>Email Address</p>
                <input name="username" class="LoginInputs" type="text" placeholder="Email">
              </div>
              <div class="box1">
                <p>Password</p>
                <input name="password" class="LoginInputs" type="text" placeholder="Password">
              </div><br>
              <button class="loginBtn">Login</button>
            </form><br>
            <?php
              if(isset($_GET["new_pass"])){
                  if(isset($_GET["new_pass"]) == "passwordupdated"){
                      echo '<br><br><p>Your password has been reset</p>';
                  }
                  
              }
            ?>
            <a class="signup" href="signUp.php" style="display: inline, margin-left : 100px;">Not yet a Member, Signup?</a>
          </div>
        </div>
      </div>
    </div>
   </div>
      </form><hr>
  </div>

 </body>
</html>