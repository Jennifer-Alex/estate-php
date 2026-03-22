<?php
require "header.php";


$sql = "SELECT * FROM properties WHERE user_id = '$user_id' ORDER BY id DESC";
$exe = mysqli_query($conn, $sql);
$users = mysqli_fetch_array($exe);
$id =  $users ['id'];

?>

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
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Sold Properties</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Description</th>
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
                                $description = $post['description'];
                              

                            ?>
                            <tr>
                                <td><?= $sn ?></td>
                                <td><img src="../uploads/<?= $image ?>" height="100"></td>
                                <td><?= $title?></td>           
                                <td><?= $price?></td>
                                <td <?= $description?>></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                           data-bs-toggle="dropdown">Action
                                        </button>
                                       <ul class="dropdown-menu">
                                           <li><a class=" dropdown-item" href="comment.php?id=<?= $post_id ?>">View Post</a></li>
                                           <li><a class=" dropdown-item" href="">Edit</a></li>
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
                    </div>
                </main>
<?php
require "footer.php";