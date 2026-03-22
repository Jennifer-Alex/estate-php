<?php
require "header.php";

$fetch_sql = "SELECT * FROM  properties WHERE user_id = '$user_id' ORDER BY id DESC";
$exe = mysqli_query($conn, $fetch_sql);


$msg = "";
if(isset($_GET['delete'])){
    $post_id = $_GET['delete'];

    $delete_query = "DELETE FROM blog WHERE id = '$post_id'";
    $exe1 = mysqli_query($conn, $delete_query);

    if($exe1){
        $msg = "<div class='alert alert-danger'> Delete Successful </div>";
    }else{
        $msg = "<div class='alert alert-success'> Failed to Delete</div>";
    }
}


?>

<div class="col-md-9 card p-3" style="backgroun-color: lightgray; width: 100%;" >


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
                    <th>Description</th>
                    <th>Price</th>
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

            ?>

                <tr>
                    <td>
                        <?=$sn ?>
                    </td>
                    <td><img src="../uploads/<?=$image?>" alt="" height="100"></td>
                    <td>
                        <?=$title?>
                    </td>
                    <td>
                        <?=$description?>
                    </td>
                    <td>
                        <?=$price?>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle"
                                data-bs-toggle="dropdown">Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class=" dropdown-item" href="">View Post</a></li>
                                <li><a class=" dropdown-item" href="">Edit</a></li>
                                <li><a class=" dropdown-item" href="">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<?php

require "footer.php";

?>