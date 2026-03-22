<?php

require "header.php";
include('conn.php');

$fetch_sql = "SELECT * FROM properties ORDER BY id DESC";
$exe = mysqli_query($conn, $fetch_sql) or die (mysqli_error($conn));




?>
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Properties <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Choose <br>Your Desired Home</h1>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section">
    	<div class="container">
        <div class="row">
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
        	<div class="col-md-4">
        		<div class="property-wrap ftco-animate">
        			<a href="properties-single.php" class="img" style="background-image: url(uploads/<?=$image?>
					"></a>
        			<div class="text">
        				<p class="price"><span class="old-price"><?=number_format($price -500)?></span><span class="orig-price"><?=number_format($price)?><small>/mo</small></span></p>
        				<ul class="property_list">
        					<li><span class="flaticon-bed"></span>3</li>
        					<li><span class="flaticon-bathtub"></span>2</li>
        					<li><span class="flaticon-floor-plan"></span>1,878 sqft</li>
        				</ul>
        				<h3><a href="properties-single.php"><?=substr($title,0,16) ?></a></h3>
        				<span class="location">Oak Land></span>
        				<a href="properties-single.php?id=<?=$id?>" class="d-flex align-items-center justify-content-center btn-custom">
        					<span class="ion-ios-link"></span>
        				</a>
        			</div>
        		</div>
        	</div>
			<?php
			}
			?>
        	


			
	    <div class="row mt-5">
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
        </div>
        
    	</div>
    </section>



    <?php

	require "footer.php";


	?>