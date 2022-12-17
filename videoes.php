<?php
    session_start();
    include "init.php";
    if(isset($_SESSION['admin'])){
        include "includes/templates/admin-navbar.php";
        echo "<h1>" . $_SESSION['admin'] . "</h1>";
    }else{
        include "includes/templates/navbar.php";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos</title>
</head>
<body>
    <div style=" height: 100vh;"> 
        <h1>Videos Page</h1>
    </div>
    <script src="includes/assists/script.js"></script>
    <script>
        navitems[2].classList.add("curr-active");
    </script>
</body>
</html>