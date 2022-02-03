<?php
  $showError="";
$showAlert=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{  include 'partial/_dbconnect.php';
    $err="";
    $username= $_POST["username"];
    $password=$_POST["password"];
    $cpassword= $_POST["cpassword"];
    // $exists=false; 
      
    $existsql= "SELECT * FROM `users` WHERE username='$username'
    ";
    $result=mysqli_query($conn,$existsql);
    $numOfRows=mysqli_num_rows($result);
 if($numOfRows>0)
 {
    // $exists=true;
    $showError="user already exist";
   }
 else{
    if(($password == $cpassword)  )
    {
       $passhash=password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` ( `username`, `password`, `date`) VALUES ( '$username', '$passhash', current_timestamp())";

        $result=mysqli_query($conn,$sql);
        if($result)
        {
          $showAlert=true;
        }
    
    }
    else
    {
        $showAlert=false;
        $showError="password does not match";
    }
  }
}



?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Signup</title>
  </head>
  <body>
  <?php
      require 'partial/_nav.php';
 ?>

  <?php
   if($showAlert==true)
   {  
       echo
     '<div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Excillent!!</strong> You are successfully completed signup process.
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
     ';
   }

  ?>
   


   <?php
   if($showAlert==false)
   {  
       echo
     '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Wrong</strong> '. $showError.'
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
     ';
   }

  ?>
   



      <div class="container"> 
         <h1 class="text-center">Signup Up here</h1>
    <form action="/loginsystem/signup.php" method="post">
  <div class="mb-3 col-md-6 style="align-items: center">
    <label for="username" class="form-label">Username</label>
    <input type="text" maxlength="11" class="form-control" id="username" name="username" placeholder="Enter username"aria-describedby="emailHelp" required>   
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" maxlength="20" placeholder="Enter password" required>
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="cpassword" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm password" required>
  </div>
  
  <div id="emailHelp" class="form-text">Well never share your data with anyone else.</div>
  </div>
 
  <button type="submit" class="btn btn-primary col-md-6">Signup</button>
</form>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>