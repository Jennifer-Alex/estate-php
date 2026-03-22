<?php
require "header.php";
$msg = "";
$status = $_GET['status'] ?? "all";

if($status == "all"){
    $fetch_sql = "SELECT * FROM properties ORDER BY id DESC";
}else if($status == "pending"){
    $fetch_sql = "SELECT * FROM properties WHERE status = 'pending' ORDER BY id DESC"; 
}else if($status == "approved"){
    $fetch_sql = "SELECT * FROM properties WHERE status = 'approved' ORDER BY id DESC";
}else{
    $fetch_sql = "SELECT * FROM properties ORDER BY id DESC";
}

$exe = mysqli_query($conn, $fetch_sql);

if(isset($_POST['Approve'])){
    $post_id = $_POST['post_id'];
    $update_sql = "UPDATE properties SET status = 'approved' WHERE id = '$post_id'";

    if(mysqli_query($conn, $update_sql)){
        $msg = "<div class='alert alert-success'>Successfully Approved</div>";
    }else{
        $msg = "<div class='alert alert-danger'>Failed</div>";
    }
}


////DELETE PROPERTIES

if(isset($_GET['delete'])){
    $post_id = $_GET['delete'];

    $delete_query = "DELETE FROM properties WHERE id = '$post_id'";
    $exe1 = mysqli_query($conn, $delete_query);

    if($exe1){
        $msg = "<div class='alert alert-danger'> Delete Successful </div>";
    }else{
        $msg = "<div class='alert alert-success'> Failed to Delete</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../boostrap/bootstrap.min.css">
    <script src="../boostrap/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="col-md-9 card p-3" style="background-color: lightgray; width: 100%;" >


        <h1>All Properties</h1>
        <br><br>
        <div class="container">
            <?= $msg ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $sn = 0;    
                while($post = mysqli_fetch_array($exe)){
                    $sn++;
                    $title = $post['title'];
                    $description = $post['description'];
                    $price = $post['price'];
                    $image = $post['image'];
                    $post_id = $post['id'];
                    $status = $post['status'];
    
                    if($status == "pending"){
                        $style = "color:red";
    
                    }else{
                        $style = "color:green";
                    }
    
                ?>
    
                    <tr>
                        <td>
                            <?=$sn ?>
                        </td>
                        <td><img src="../uploads/<?=$image?>" alt="" height="100"></td>
                        <td style="width:200px">
                            <?=$title?>
                        </td>
                        <td style="width:200px; <?=$style?>">
                           <?=$status?>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown">Action
                                </button>
                                <ul class="dropdown-menu">
                                    <?php
                                       if($status == "pending"){?>
                                       <li>
                                          <form method="Post">
                                               <input type="hidden" value="<?=$post_id?>" name="post_id">
                                               <input type="submit" value="Approve" name="Approve" class="dropdown-item">
                                          </form>
                                       </li>
                                    <?php } ?>   
                                    <li><a class=" dropdown-item" href="">View Post</a></li>
                                    <li><a class=" dropdown-item" href="">Edit</a></li>
                                    <li><a class=" dropdown-item" href="all_property.php?delete=<?= $post_id ?>">Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
    
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    
</body>
</html>
<?php

require "footer.php";

?>