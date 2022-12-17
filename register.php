<?php
    // ob_start();
    session_start();
    include "init.php";

    include "includes/templates/header.php";
    if(isset($_SESSION['admin'])){
        include "admin/includes/templates/navbar-register.php";
    }else{
        include "includes/templates/navbar.php";
    }
    // \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

    //Initialization
    $name=$email=$pwrd=$cnfpwrd="";             // handle the inputs data
    $nameErr=$emailErr=$pwrdErr=$cnfpwrdErr=""; // catch the errors
    $namef=$emailf=$pwrdf=$cnfpwrdf=false;      // flags for inputs - true or false

    function correctInput($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    function chkLength($str,$l){
        return strlen($str)<$l;
    }

    // when click submit button
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['save-register'])){
        $name= correctInput($_POST['uname']);
        $email= correctInput($_POST['email']);
        $pwrd= $_POST['pwd'];
        $cnfpwrd= $_POST['cnfpwd'];
        if(isset($_SESSION['admin'])){
            $status = $_POST['status'];
            $role = $_POST['role'];
        }
        //check the inputs
        if(empty($name)){
            $nameErr="Name is required";
        }elseif(chkLength($name,3)){
            $nameErr="Must be more than 3 chars";
        }else{
            //Rremove all HTML tags from name
            $name = filter_var($name, FILTER_SANITIZE_STRING);
            $namef=true;
        }
        if(empty($email)){
            $emailErr="Email is required";
        }else{
            //Remove all illegal characters from email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            //Validate e-mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $emailf=true;
            }else{
                $emailErr= "type a valid email";
            }            
        }
        if(empty($pwrd)){
            $pwrdErr="Password is required";
        }elseif(chkLength($pwrd,8)){
            $pwrdErr="Must be more than 8 chars";
        }else{
            $pwrdf=true;
        }
        if(empty($cnfpwrd)){
            $cnfpwrdErr="Rewrite same Passwrd";
        }elseif($cnfpwrd != $pwrd){
            $cnfpwrdErr="Matching failed, try again.";
        }else{
            $cnfpwrdf=true;
        }

        // Saving User's Data, when the all inputs are correct.
        if ($namef && $emailf && $pwrdf && $cnfpwrdf){
            if(isset($_SESSION['admin'])){
                $saveuser_stmnt = $connect->prepare("
                insert into users
                values (null, :zname, :zemail, :zpwrd, :zstatus, :zrole, now(), now());
                ");
                $saveuser_stmnt->execute(array(
                    'zname' => $name,
                    'zemail' => $email,
                    'zpwrd' => sha1($pwrd),
                    'zstatus' => $status,
                    'zrole' => $role
                ));
            }else{
                $saveuser_stmnt = $connect->prepare("
                insert into users
                values (null, :zname, :zemail, :zpwrd, :zstatus, :zrole, now(), now());
                ");
                $saveuser_stmnt->execute(array(
                    'zname' => $name,
                    'zemail' => $email,
                    'zpwrd' => sha1($pwrd),
                    'zstatus' => 0,
                    'zrole' => 'user'
                ));
            }
            if($saveuser_stmnt->rowcount() > 0){
                if(isset($_SESSION['admin'])){
                    echo "
                    <div class='text-center mt-3'>
                    <span class='text-center text-primary'> $name Added Successfuly.</span>
                    </div>
                    ";
                    header("Refresh:1; url=admin/users.php");
                    exit();
                }else{
                    echo "
                    <div class='text-center mt-3'>
                    <span class='text-center text-primary'> You Added Successfuly.</span>
                    </div>
                    ";
                    $_SESSION['uname'] = $name;
                    header("Refresh:1; url=home.php");
                    exit();
                }
            }
        }
    }
?>

<div class="container">
    <div class="mx-auto col mt-1 register">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="frm">
        <div class="title mb-4">
            <?php
                if(isset($_SESSION['admin'])){
                    echo "<h3>Adding User</h3>";
                }else{
                    echo"<h3>Register</h3>";
                    echo"<p>It's free and hardly takes more than 30 seconds.</p>";
                }
            ?>
        </div>

        <div class="form-floating">           
            <input type="text" class="form-control" id="floatingPassword" placeholder="Name" name="uname" value="<?php echo $name ?>">
            <label for="floatingInput">Name</label>
        </div>
        <div class="err"><span class="text-warning"><?php echo $nameErr ?></span></div>

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?php echo $email ?>">
            <label for="floatingInput">Email address</label>                
        </div>
        <div class="err"><span class="text-warning"><?php echo $emailErr ?></span></div>

        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pwd" value="<?php echo $pwrd ?>">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="err"><span class="text-warning"><?php echo $pwrdErr ?></span></div>

        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="cnfpwd">
            <label for="floatingPassword">Confirm Password</label>                
        </div>
        <div class="err"><span class="text-warning"><?php echo $cnfpwrdErr ?></span></div>
        <?php if(isset($_SESSION['admin'])){ ?>
            <div class="d-flex justify-content-around mt-2 p-3 border border-info rounded">
                <div>
                <input type="radio" id="html" name="role" value="user" checked>
                <label for="html" class="text-white">User</label>
                <input type="radio" id="html" name="role" value="admin">
                <label for="html" class="text-white">Admin</label>
                </div>
                <div>
                <input type="radio" id="html" name="status" value="approved" checked>
                <label for="html" class="text-white">Approved</label>
                <input type="radio" id="html" name="status" value="pending">
                <label for="html" class="text-white">Pending</label>
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" name="save-register" class="btn btn-outline-info btn-lg w-50">Save</button>    
            </div>
        <?php }else{ ?>
        <div class="trailer">
            <button type="submit" name="save-register" class="btn btn-outline-info">Register Now</button>
            <p>By clicking th Register Now,you agree to our <br>
                <span class="spn text-info">Teams </span> and <span class="spn text-info">Privacy Policy</span>. 
            </p>    
        </div> 
        <?php } ?>         

    </form>
    </div>
</div>
