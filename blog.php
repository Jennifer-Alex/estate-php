<?php

require "header.php";
include('conn.php');

$fetch_sql = "SELECT * FROM properties ORDER BY id DESC";
$exe = mysqli_query($conn, $fetch_sql) or die (mysqli_error($conn));

$sql = "SELECT * FROM users ";
$exe1 = mysqli_query($conn, $sql);
$users = mysqli_fetch_array($exe1);



?>
    
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Our Blog</h1>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section">
      <div class="container">
        <div class="row d-flex">


         <?php
			     while($property = mysqli_fetch_assoc($exe)){
			  	  $id = $property['id'];
				    $title = $property['title'];
				    $price = $property['price'];
				    $type = $property['type'];
				    $category = $property['category'];
				    $description = $property['description'];
				    $image = $property['image'];

			    ?> 
          <div class="col-md-3 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <div class="text">
                <h3 class="heading"><a href="#"><?= $title?></a></h3>
                <div class="meta mb-3">
                  <div><a href="#">July. 24, 2019</a></div>
                  <div><a href="#"><?= $users ['role']?></a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <a href="blog-single.php" class="block-20 img" style="background-image: url('uploads/<?= $image?>');">
	              </a>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
         <?php
            }
           ?>
        <!-- <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div> -->
      </div>
    </section>

    <?php

    require "footer.php";

    ?>