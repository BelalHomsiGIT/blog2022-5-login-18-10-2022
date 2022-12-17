<!-- <style>
  .d-item{
    background-color: blue;
  }
</style> -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../home.php">
    <img src="includes/imgs/php-mysql1.png" alt="logo" width="80" height="50">
      HOME  
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- I added nav justify-content-end to justify it to right -->
    <div class="collapse navbar-collapse nav justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav" id="ulnav">
        <li class="nav-item">
          <a class="nav-link" id="dash-link" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="users.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="posts.php">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="comments.php">Comments</a>
        </li>
        <li class="nav-item dropdown me-2">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['uname'] ?>
          </a>
          <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
            <!-- <li><a class="dropdown-item" href="#">Login</a></li> -->
            <li class="d-item"><a class="dropdown-item text-white-50" href="#">Profile</a></li>
            <li><hr class="dropdown-divider  text-white"></li>
            <li><a class="dropdown-item text-white-50" href="../logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<script>
  const navitems = document.getElementsByClassName("nav-link");
  // console.log(navitems[0])
</script>