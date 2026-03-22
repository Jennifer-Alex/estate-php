<?php
session_start();
$msg = "";

require "header.php";
include('conn.php');
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Login'])){
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    $login_sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $login_sql) or die(mysql1_error($conn));

    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);
      if(password_verify($password, $row['password'])){
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $role = $row['role'];

        if($role == "admin"){
          $_SESSION['admin_id'] = $row['id'];
          $_SESSION['admin_name'] = $row['email'];
          header("Location: admin/index.php");
        }else{
          header("Location:dashboard/index.php");
        }
      }else{
        $msg = "<div class='alert alert-danger'>Incorrect password, please try again.</div>".mysqli_error($conn);
      
      }

    }else{
        $msg = "<div class='alert alert-danger'>No account Found With this Email, pls try again</div>";
    }

  }else{
    $msg = "<div class='alert alert-danger'>Invalid Email format, please try again.</div>";
  }

}


?>
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg " style="background-image: url('images/bg_1.jpg'); height: 400px !important;" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Login<i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">LOGIN INTO YOUR ACCOUNT</h1>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section contact-section">

    <div class= "container">
      <?= $msg ?>
        <div class="row block-9 justify-content-center mb-5">
          <div class="col-md-8 mb-md-5">
            <form action="#" method="POST" class="bg-light p-5 contact-form">
              <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="password" placeholder="Password">
              </div>
              <div class="form-group">
                <input type="submit" name="Login" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          
          </div>
        </div>
      </div>
    </section>

    <?php

    require "footer.php";

    ?>
