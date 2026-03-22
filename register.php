<?php
session_start();
require "header.php";

$msg = "";
$full_name ="";
$email = "";
$phone_number = "";
$password = "";
$confirm_password = "";

if(isset($_POST['register'])){
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];


  $full_name = mysqli_real_escape_string($conn,$full_name);
  $email = mysqli_real_escape_string($conn,$email);
  $phone_number = mysqli_real_escape_string($conn,$phone_number);
  $password = mysqli_real_escape_string($conn,$password);
  $confirm_password = mysqli_real_escape_string($conn,$confirm_password);
  

  if(strlen($full_name) > 3){
    if(strlen($phone_number) > 10){
      if(strlen($password) > 5){
        if(strlen($confirm_password) > 3){
          if($password == $confirm_password){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
              //VALID INPUT
              $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
              $register_sql = "INSERT INTO users(fullname, email, phone, password)
                                    VALUES('$full_name', '$email', '$phone_number', '$hashed_password')";
              $exec = mysqli_query($conn,$register_sql) or die(mysql1_error($conn)); 
              if($exec){
                $msg = "<div class='alert alert-success'>Registration Successful Welcome $full_name </div>";
  
                ///SENDMAIL///
                // mail($email, "Hello $full_name your are welcome");
  
                ////////////////
                $last_id = $conn->insert_id;
  
  
  
                $_SESSION['id'] = $last_id;
                $_SESSION['email'] = $email;
                header("Location:dashboard/index.php");
  
  
  
              }else{
  
                $msg = "<div class='alert alert-danger'>Registration Failed </div>";
  
              } 
              
              
            }else{
  
              $msg = "<div class='alert alert-danger'>Invalid Email</div>";
  
            }
  
  
          }else{
  
            $msg = "<div class='alert alert-danger'>Password does not match confimation </div>";
  
          }
  
  
        }else{
          $msg = "<div class='alert alert-danger'>Password too short </div>";
        }
  
  
      }else{
  
        $msg = "<div class='alert alert-danger'>Password too short </div>";
      }
  
    }else{
  
      $msg = "<div class='alert alert-danger'>Phone Number too short </div>";
    }

  
  }else{
  
    $msg = "<div class='alert alert-danger'>Full Name too short </div>";
  }
}

?>
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg " style="background-image: url('images/bg_1.jpg'); height: 400px !important;" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text  align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Register <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Create Account</h1>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section contact-section">
      <div class="container">
       <?= $msg ?>
        <div class="row block-9 justify-content-center mb-5">
          <div class="col-md-8 mb-md-5">
            <form action="#" method="POST" class="bg-light p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" name="full_name" value="<?=$full_name?>" placeholder="Full Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="email" value="<?=$email?>"  placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="phone_number" value="<?=$phone_number?>" placeholder="Phone Number">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="password" value="<?=$password?>" placeholder="Password">
              </div>
              <div class="form-group">
                <input type="text" class="form-control"name="confirm_password" value="<?=$confirm_password?>" placeholder=" Confirm Password">
              </div>
              <div class="form-group">
                <input type="submit" name="register" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          
          </div>
        </div>
      </div>
    </section>

    <?php

    require "footer.php";

    ?>