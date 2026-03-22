<?php
require "header.php";
$msg = "";



/////SELECT

$sql = "SELECT * FROM users ";
$exe = mysqli_query($conn, $sql);
$users = mysqli_fetch_array($exe);
$id =  $users ['id'];


if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $delete_query = "DELETE FROM users WHERE id = '$id'";
    $exe1 = mysqli_query($conn, $delete_query);

    if($exe1){
        $msg = "<div class='alert alert-danger'> Delete Successful </div>";
    }else{
        $msg = "<div class='alert alert-success'> Failed to Delete</div>";
    }
}

if(isset($_GET['admin'])){
    $user_id = $_GET['admin'];

    $upd_query = "UPDATE users SET role = 'admin' WHERE id = '$user_id'";
    $exe2 = mysqli_query($conn, $upd_query);

    if($exe2){
        $msg = "<div class='alert alert-success'> Update Successful </div>";
    }else{
        $msg = "<div class='alert alert-success'> Failed to update</div>";
    }

}


if(isset($_GET['user'])){
    $user_id = $_GET['user'];

    $upd_query = "UPDATE users SET role = 'user' WHERE id = '$user_id'";
    $exe2 = mysqli_query($conn, $upd_query);

    if($exe2){
        $msg = "<div class='alert alert-success'> Update Successful </div>";
    }else{
        $msg = "<div class='alert alert-success'> Failed to update</div>";
    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../boostrap/bootstrap.bundle.min.js"></script>
    <link href="../boostrap/bootstrap.min.css"/>
    <title>Document</title>
</head>
<body>
     
    <div class="col-md-9 card p-3" style="background-color: lightgray; width: 100%;">


        <h1>All Users</h1>
        <br><br>
        <div class="container">
            <?= $msg ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $sn = 0;    
                while($user = mysqli_fetch_array($exe)){
                    $sn++;
                    $id = $user['id'];
                    ?>
                    <tr>
                        <td>
                            <?=$sn?>
                        </td>
                        <td>
                            <?= $user ['fullname'] ?>
                        </td>
                        <td>
                            <?= $user ['email'] ?>
                        </td>
                        <td>
                            <?= $user ['phone'] ?>
                        </td>
                        <td>
                            <?= $user ['role'] ?>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown">Action
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class=" dropdown-item" href="all_users.php?delete=<?= $id ?>">Delete</a> </li>
                                    <li><a class=" dropdown-item" href="all_users.php?admin=<?= $id ?>">Make Admin</a></li>
                                    <li><a class=" dropdown-item" href="all_users.php?user=<?= $id ?>">Make User</a></li>
                                    </li>
                                </ul>
                            </div>
    
    
                    </tr>
                    <?php }?>
    
                </tbody>
            </table>
        </div>
    </div>
    
    
    
</body>
</html>
<?php

require "footer.php";

?>

<?php
require "footer.php";

?>