<?php
session_start();
//1-connect with DB + appearing the header
    include "init.php";
    include "includes/templates/navbar.php";
    
//2-get specified data from database
// if(isset())
    $adminID = $_SESSION['adminID'];
    $allUsersQr = $connect->prepare("select * from users where id != $adminID");
    $allUsersQr->execute();
    $usersCount = $allUsersQr->rowcount();
    $users = $allUsersQr->fetchAll();
?>
<!-- 
//3-the content of dashboard.php - users page 
-->
    <div class="main">
    <div class="container">
        <!-- <h4 style="text-align:center;">Users Management</h4> -->
        <div class="card mt-4">
            <div class="card-header">
            <h4 class="text-center">Users Management</h4>
            <div class="d-flex justify-content-md-between">
                <button style="width:100px;" type="button" class="btn btn-outline-danger pe-none">
                    <span class="badge bg-danger"><?php echo $usersCount; ?></span> USERS
                </button>
                <a style="width:100px;" class="btn btn-outline-primary" href="../register.php" role="button">
                <i class="fa fa-user-plus"></i> NEW</a>
            </div>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <?php
                        if($usersCount>0){
                            foreach($users as $user){
                    ?>
                    <tbody>
                        <tr>
                        <th scope="row"><?php echo $user["id"] ?></th>
                        <td><?php echo $user["username"] ?></td>
                        <td><?php echo $user["email"] ?></td>
                        <td><?php echo $user["role"] ?></td>
                        <td>
                            <?php 
                                if($user['status'] == 0){
                                    echo'<span class="badge rounded-pill bg-dark text-white-50 user-status">Blocked</span>';
                                }elseif($user['status'] == 1){
                                    
                                    echo'<span class="badge rounded-pill bg-success user-status">Approved</span>';
                                }else{
                                    echo'<span class="badge rounded-pill bg-warning text-danger user-status">Pending</span>';
                                }
                            ?>
                        </td>
                        <td>
                            <!-- <a class="btn btn-success" title="Edit" href="#">
                                <i class="fa fa-edit fa-xs"></i>
                            </a>
                            <a class="btn btn-primary" title="Add" href="#">
                                <i class="fa fa-user-plus fa-xs"></i>
                            </a>
                            <a class="btn btn-danger" title="Del" href="#">
                                <i class="fa fa-trash fa-xs"></i>
                            </a> -->
                            <a class="btn btn-info" title="Details" href="#">
                                <i class="fa fa-eye fa-xs"></i>
                            </a>
                        </td>

                        </tr>
                    </tbody>
                    <?php
                        }
                    }else{
                    ?>
                    <p>No Users!.</p>
                    <?php
                            }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
//4-appearing the footer
    include "includes/templates/footer.php";
?>

<!-- 
//5-JS actions
 -->
<script src="includes/assists/script.js"></script>
<script>
    navitems[1].classList.add("curr-active");
</script>