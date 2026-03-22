<?php
require "header.php";

$msg = "";
if(isset($_POST['post'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $image = $_FILES['image'];

    $image_name = basename($_FILES['image']['name']);
    $target_dir = "../uploads/".$image_name;
    $upload = move_uploaded_file($_FILES['image']['tmp_name'], $target_dir);
    if($upload){
        $post_sql = "INSERT INTO properties(user_id, title, price, type, category, description, image) VALUES('$user_id','$title', '$price', '$type', '$category', '$description', '$image_name')";
        $result = mysqli_query($conn, $post_sql) or die(mysqli_error($conn));
        if($result){
            $msg = "<div class='alert alert-success'>Property added successfully.</div>";
        }else{
            $msg = "<div class='alert alert-danger'>Failed to add property. Please try again.</div>";
        }
    }else{
        $msg = "<div class='alert alert-danger'>Failed to upload image. Please try again.</div>";
    }    
}
?> 

<div class="container">
    <?= $msg; ?>
    <form action="" method="POST" enctype="multipart/form-data" class="m-5 p-5">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" required>
        </div>
        <!-- <div class="form-group">
            <label for="size">Size</label>
            <input type="number" class="form-control" name="size" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" required>
        </div> -->
        <div class="form-group">
            <label for="type">Select Type</label>
            <select name="type" class="form-control" required>
                <option value="rent">Rent</option>
                <option value="sale">Sale</option>
            </select>
        </div>
        <div class="form-group">
            <label for="category">Select Category</label>
            <select name="category" class="form-control" required>
                <option value="apartment">Apartment</option>
                <option value="house">House</option>
                <option value="office">Office</option>
                <option value="land">Land</option>
            </select>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" name="location" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <input type="submit" value="Post Property" name="post" class="btn btn-primary">
        </div>
    </form>
</div>

<?php
require "footer.php";
?>