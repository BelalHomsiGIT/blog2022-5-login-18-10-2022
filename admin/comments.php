<?php
    session_start();
    //1-connect with DB + appearing the header
    include "includes/templates/navbar.php";
    include "init.php";

    //2-get specified data from database

?>
<div class="main">
    <div class="container">
        <h4 style="text-align:center;">Comments Management</h4>
    </div>
</div>

<?php
    //3-appearing the footer
    include "includes/templates/footer.php";
?>

<script src="includes/assists/script.js"></script>
<script>
    navitems[4].classList.add("curr-active");
</script>