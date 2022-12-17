<?php
session_start();
//1-connect with DB + appearing the header
include "init.php";
// include "includes/templates/admin-navbar.php";
if( isset($_SESSION['admin']) ){
    include "includes/templates/navbar.php";
    //2-get specified data from database
    // $adminID = $_SESSION['adminID'];
    $qry1 = $connect -> prepare("select * from users");
    $qry1->execute();
    $u_count = $qry1->rowcount();
    //
    $qry2 = $connect -> prepare('select * from categories');
    $qry2->execute();
    $c_count = $qry2->rowcount();
    //
    $qry3 = $connect -> prepare('select * from posts');
    $qry3->execute();
    $p_count = $qry3->rowcount();
    //
    $qry4 = $connect -> prepare('select * from comments');
    $qry4->execute();
    $comm_count = $qry4->rowcount();


?>
<!-- 
//3-the content of dashboard.php - dashboard page 
-->
    
    <!-- 
        <h6 style="color: #1e90ff;
               font-style: italic; width:max-content;">
            My Dashbord
        </h6> 
    -->

    <div class="container-fluid pt-5">
        <div class="main">
            <div class="row justify-content-evenly">
                <div class="box col-sm-2 border border-secondary rounded-3 m-2">
                    <div class="statistics-icon"> <i class="fas fa-users"></i> </div>
                    <div class="statics-box d-flex justify-content-around">
                        <div> <h3> <?php echo $u_count ?> </h3> </div>
                        <div> <h4> Users </h4> </div>
                    </div>
                </div>
                <div class="box col-sm-2 border border-secondary rounded-3 m-2">
                    <div class="statistics-icon"> <i class="fas fa-shapes"></i> </div>
                    <div class="statics-box d-flex justify-content-around">
                        <div> <h3> <?php echo $c_count ?> </h3> </div>
                        <div> <h4> Categories </h4> </div>
                    </div>
                </div>
                <div class="box col-sm-2 border border-secondary rounded-3 m-2">
                    <div class="statistics-icon"> <i class="fas fa-paste"></i> </div>
                    <div class="statics-box d-flex justify-content-around">
                        <div> <h3> <?php echo $p_count ?> </h3> </div>
                        <div> <h4> Posts </h4> </div>
                    </div>
                </div>
                <div class="box col-sm-2 border border-secondary rounded-3 m-2">
                    <div class="statistics-icon"> <i class="fas fa-comments"></i> </div>
                    <div class="statics-box d-flex justify-content-around">
                        <div> <h3> <?php echo $comm_count ?> </h3> </div>
                        <div> <h4> Comments </h4> </div>
                    </div>
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
    navitems[0].classList.add("curr-active");
</script>

<?php
}else{
    echo "<div class='alert alert-primary m-5'> You Are Not AUTHENTICATED !! </div>";
    header('refresh:3; url=../login.php');
    exit();
}
?>