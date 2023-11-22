<?php

require 'init.php';
//after login donot go login
if (isset($_SESSION['user'])){
    go('index.php');
}

// $errors =[];
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email =$_REQUEST['email'];
    $password =$_REQUEST['password']; 
    //validation
    if(empty($email)){
    setError('Please enter email');
    }
    if(empty($password)){
    setError('Please enter password');
    }
     
    $user = getOne(
        'select * from users where email=?',
        [$email]
    );
    //not found
    if(!$user){
        setError("Email not found");
    }
    //found
    if($user){
        $ver =password_verify($password, $user->password);
        if(!$ver){
            setError("Wrong password");
        }
    }

    //login
    if(!hasError()){
        // echo 'validate';
        // $user = query(
        //     'select * from users where email=?'
        //     [$email]
        // );
        $_SESSION['user'] = $user;
        go('index.php');
    }

}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/argon-design-system.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container text-center mt-5">
      <div class="row">
        <div class="col-4 offset-4">
          <div class="card">
            <div class="card-header bg-dark text-white">Login</div>
            <div class="card-body">
                <?php
                    showError();
                ?> 
              <form action="" method="POST">
                <div class="form-group">
                  <label for="">Enter Email</label>
                  <input type="text" name="email" class="form-control" />
                </div>
                <!-- password -->
                <div class="form-group">
                  <label for="">Enter Password</label>
                  <input type="text" name="password" class="form-control" />
                </div>
                <input type="submit" value="Login" class="btn btn-primary" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>

