<?php
require "header.php";
include('../conn.php');
$msg = "";

$users = "SELECT * FROM users";
$users_res = mysqli_query($conn, $users);
$total_users = mysqli_num_rows($users_res);



$sql = "SELECT * FROM properties ";
$exe = mysqli_query($conn, $sql);
$users = mysqli_fetch_array($exe);
$id =  $users ['id'];


if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $delete_query = "DELETE FROM properties WHERE id = '$id'";
    $exe1 = mysqli_query($conn, $delete_query);

    if($exe1){
        $msg = "<div class='alert alert-danger'> Delete Successful </div>";
    }else{
        $msg = "<div class='alert alert-success'> Failed to Delete</div>";
    }
}

function getPropertyFilter($filter = ""){
    if($filter == ""){
        $properties = "SELECT * FROM properties";
    }else{
        $properties = "SELECT * FROM properties WHERE $filter";
    }

    $conn = $GLOBALS['conn'];
    $properties_res = mysqli_query($conn,$properties);
    $total_properties = mysqli_num_rows($properties_res);
    return $total_properties;
}

$total_properties = getPropertyFilter("");
$pending_properties = getPropertyFilter("status = 'pending'");
$approved_properties = getPropertyFilter("status = 'approved'");

$fetch_sql = "SELECT * FROM properties ORDER BY id DESC";
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
    
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Total Properties</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="all_property.php?status=all"><?=$total_properties?> Properties</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Pending Properties</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="all_property.php?status=pending"><?=$pending_properties?>Properties</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Approved Properties</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="all_property.php?status=approved"><?=$approved_properties?>Properties</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Total Users</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="all_users.php"><?= $total_users?></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Recent Properties
                </div>
                <div class="card-body">
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sn = 0;

                            while($post = mysqli_fetch_array($exe)){
                                $sn++;
                                $image = $post['image'];
                                $title = $post ['title'];
                                $price = $post['price'];
                                $post_id = $post['id'];
                                $status = $post['status'];


                                if($status == "pending"){
                                    $style = "color:red";
                                }else{
                                    $style = "color:green";
                                }
                            

                            ?>
                            <tr>
                                <td><?= $sn ?></td>
                                <td><img src="../uploads/<?= $image ?>" height="100"></td>
                                <td><?= $title?></td>           
                                <td><?= $price?></td>
                                <td style = "<?= $style?>"><?= $status?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                           data-bs-toggle="dropdown">Action
                                        </button>
                                       <ul class="dropdown-menu">
                                          <?php
                                              if($status == "pending"){ 
                                            ?>
                                           <li>
                                               <form method="post">
                                                  <input type="hidden" value="<?=$post_id?>" name="post_id"> 
                                                  <input type="submit" class="dropdown_item" name="Approve" Value="Approve">
                                               </form>
                                           </li>
                                           <?php }?>
                                           <li><a class=" dropdown-item" href="comment.php?id=<?= $post_id ?>">View Post</a></li>
                                           <li><a class=" dropdown-item" href="">Edit</a></li>
                                           <li><a class=" dropdown-item" href="index.php?delete=<?= $post_id ?>">Delete</a></li>
                                        </ul>
                                    </div>
                              </td>
                            </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
<?php
require "footer.php";