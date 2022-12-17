<?php
    session_start();
    include "init.php";
    if(isset($_SESSION['admin'])){
        include "includes/templates/admin-navbar.php";
        // echo "<h1>" . $_SESSION['admin'] . "</h1>";
    }else{
        include "includes/templates/navbar.php";
    }
?>
    <div style=" height: 100vh;"> 
        <h1>Blog Page</h1>
    </div>
    <script src="includes/assists/script.js"></script>
    <script>
        navitems[1].classList.add("curr-active");
    </script>
