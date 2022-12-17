<?php
//1-connect with DB + appearing the header + session
    session_start();
    //if the admin already logged in:
    if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){
        header('location: admin/dashboard.php');
        exit();
    }
    //if the user already logged in:
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
        header('location: home.php');
        exit();
    }
    include "includes/templates/navbar.php";
    include "init.php";
    //
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['login-user'])){
            $email = $_POST['email'];
            $pwrd = $_POST['password'];
            $sha1pwrd = sha1($pwrd);
            /*
            Encrypt Methods for the password:
            --------------------------------
            $sha1pwrd = sha1($pwrd);
            $md5pwrd = md5($pwrd);
            $hash1pwrd = password_hash($pwrd, PASSWORD_DEFAULT);
            $hash2pwrd = password_hash($pwrd, PASSWORD_BCRYPT);
            //
            echo $email . "<br>";
            echo $pwrd . "<br>";
            echo $sha1pwrd . "<br>";
            echo $md5pwrd . "<br>";
            echo $hash1pwrd . "<br>";
            echo $hash2pwrd . "<br>";
            */
            $checkQry = $connect->prepare("select * from users where email=? and password=?");
            $checkQry->execute(array($email, $sha1pwrd));
            $checkQryRow = $checkQry->rowCount();
            if($checkQryRow > 0){
                echo 'User Found';
                $daatauser = $checkQry->fetch();
                $_SESSION['uname'] = $daatauser['username'];

                if($daatauser['role'] == 'admin'){
                    echo " is Admin...";
                    $_SESSION['admin'] = $email;
                    $_SESSION['adminID'] = $daatauser['id'];
                    header('refresh:3; url=admin/dashboard.php');
                    // header('Location: admin/dashboard.php');
                    exit();
                }else{
                    echo " is Not Admin !!!";
                    $_SESSION['user'] = $email;
                    header('refresh:3; url=home.php');
                    // header('Location: home.php');
                    exit();
                }
            }else{
                echo 'User Not Found !!!!';
            }
        }else{
            echo "Error";
        }
    }else{
        echo "Fatal Err";
    }
?>

<div class="container d-flex px-5" style=" height: 100vh;">
    <div class="w-50">
        <h2 class="text-center mt-3">LOGIN</h2>
        <div class="mx-auto">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="********">
                </div>
                <div class="col-auto text-center">
                    <button style="width: 50%; height: 50px; font-size: 22px;" type="submit" name="login-user" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
    <div class="w-50" style="padding-top: 5%;">
        <h3 class="text-center mt-3">REGISTER</h3>
        <div class="mx-auto">
            <form action="register.php" method="post">
                <div class="col-auto text-center">
                    <p style="line-height: 50PX;">Register here if you dont have account !</p>
                </div>
                <div class="col-auto text-center">
                    <button style="width: 50%; height: 50px; font-size: 22px;" type="submit" name="register-user" class="btn btn-outline-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>