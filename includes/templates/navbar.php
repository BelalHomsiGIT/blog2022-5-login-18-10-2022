<!-- <?php
session_start();
?> -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand ms-2" href="#">
      <img src="includes/imgs/php-mysql1.png" alt="logo" width="80" height="50">
      My Courses
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- I added nav justify-content-end to justify it to right -->
    <div class="collapse navbar-collapse nav justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav" id="ulnav">
        <li class="nav-item">
          <a class="nav-link" id="dash-link" aria-current="page" href="home.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="dash-link" aria-current="page" href="blog.php">BLOG</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="videoes.php">VIDEOES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="courses.php">COURSES</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="online.php">ONLINE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">ABOUT</a>
        </li>

        <?php
          if(isset($_SESSION['uname'])){
        ?>
          <li class="nav-item dropdown me-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION['uname'] ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <!-- <li><a class="dropdown-item" href="#">Login</a></li> -->
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
          
        <?php
          }else{
        ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">LOGIN</a>
          </li>
        <?php
          }
        ?>
      </ul>
    </div>
  </div>
</nav>
<script>
  const navitems = document.getElementsByClassName("nav-link");
  // console.log(navitems[0])

</script>