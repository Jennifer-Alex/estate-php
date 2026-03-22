<?php
require "conn2.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM properties WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query Failed:".mysqli_error($conn));
    }
    if(mysqli_num_rows($result) > 0){
        $post = mysqli_fetch_assoc($result);
        $title = $post['title'];
        $price = $post['price'];
        $image = $post['image'];
        $description = $post['description'];
    }else{
       echo "Post not Found";
       exit;
    }


}else{ 
    echo "Invalid Post ID.";
}




if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query2 = "DELETE * FROM properties WHERE id = $id";
    $result1 = mysqli_query($conn, $query2);


}else{
    echo "Invalid Post ID.";
}


// if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])){
//     $comment = mysqli_real_escape_string($conn, $_POST['comment']);
//     $query = "INSERT INTO comments (post_id, comment) VALUES ($id, '$comment')";
//     if(!mysqli_query($conn, $query)){
//         die("comment submission failed:" .mysqli_error($conn));
//     }
// }

// $comments_query = "SELECT * FROM comments WHERE id = $id ORDER BY date_created DESC";
// $comment_result = mysqli_query($conn, $comments_query);

// if(!$comments_query){
//     die("Comments Query Failed: ". mysqli_error($conn));
// }

?>


<!DOCTYPE html>
    <html lang="en">


    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../boostrap/bootstrap.min.css">
    <script src="../bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1><?= $title ?></h1>
        <img src="../uploads/<?=$image?>" alt="" class="img-thumbnail" style="height: 500px; width: 100%;">
        <center>
           <h3>
              <span>Price =</span> <span>N<?=number_format($price) ?></span> 
            </h3>
            <h3>
                <?= $description ?>
            </h3>
            
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal" type="button" >BUY NOW</button>
        </center>

        <!--------THE MODAL--------->

	<div class="modal" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
			   <div class="modal-header">
			       <h4 class="modal-title">Customer Information</h4>
			       <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
		        </div>

				<!-----Modal Header----->
				<div class="Modal-body">
					<div class="form">
						<form id="paymentForm">
							<div class="mb-3 mt-3">
								<input class="form-control" type="" name="" id="email" placeholder="Enter Email">
							</div>
							<div class="mb-3 mt-3">
								<input class="form-control" type="" name="" id="firstname" placeholder="Enter First Name">
							</div>
							<div class="mb-3 mt-3">
								<input class="form-control" type="" name="" id="lastname" placeholder="Enter Last Name">
							</div>
							<input class="form-control" type="hidden" name="" id="pid" value="<?=$property_id?>">
							<input class="form-control" type="hidden" name="" id="price" value="<?=$prce?>">
							<button type="submit" onclick="payWithPaystack()" class="btn btn-success" id="paynow">Continue</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-------End Service Detailed Area------>
	<script src="https://js.paystack.co/v2/inline.js"></script>

	<!--------Container Fluid ------>

	<script type="text/javascript">
		const paymentForm = document.getElementById('paymentForm');
		paymentForm.addEventListener("submit",payWithPaystack,false);

		function payWithPaystack(e){
			e.preventDefault();
			var amount = document.getElementById("price").value

			let handler = paystackPop.setup({
				key:
				email: document.getElementId("email").value,<?php echo $email?>,
				firstname: document.getElementId("firstname").value,<?php echo $firstname?>,
				lastname: document.getElementId("lastname").value,<?php echo $lastname?>,
				ref: ''+math.floor((math.random() *100000000) + 1),
				
				// generates a pseudo-unique reference. please replace with a reference you generated.
				// Or remove the line entirely
				// label: "optional string that replaces customer email" 

				onclose :function(){
					alert('window ')
				},

				callback: function(response){

					///insert user
				}
			});
			handler.openIframe();
		}
	</script>

	<?php
	require "footer.php";
	?>
