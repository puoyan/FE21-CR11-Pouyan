<?php
session_start();
require_once 'components/db_connect.php';

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user']) != "") {
    header("Location: home.php");
    exit;
}


$error = false;
$email = $password = $emailError = $passError = '';

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing
        $sql = "SELECT id, first_name, password, status FROM user WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if ($count == 1 && $row['password'] == $password) {
            if($row['status'] == 'adm'){
            $_SESSION['adm'] = $row['id'];           
            header( "Location: dashBoard.php");}
            else{
                $_SESSION['user'] = $row['id']; 
               header( "Location: home.php");
            }          
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login & Registration System</title>

<?php require_once 'components/boot.php'?>
<style type="text/css">
body{
    background:url(animals/pictures/laklak.jpeg);  
}

</style>


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #2E303C!important;">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">Animal adoption platform</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>   
     </ul>
      
    </div>
  </div>
</nav>




    <div class="container">
        <div class="row mt-5">
            <div class="col col-md-6">
            <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            <h2>LogIn</h2>
            <hr/>
            <?php
            if (isset($errMSG)) {
                echo $errMSG;
            }
            ?>

            
        
           <div class="form-group">
           <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>"  maxlength="40" />
            <span class="text-danger"><?php echo $emailError; ?></span>
           </div>
             <br/>   
            <div class="form-group">
            <input type="password" name="pass"  class="form-control" placeholder="Your Password" maxlength="15"  />
            <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            <hr/>
            <button class="btn btn-block btn-primary" type="submit" name="btn-login">Sign In</button>
            <hr/>
            <a style="text-decoration:none "href="register.php">Not registered yet? Click here</a>
        </form>
            </div>
        </div>
    
    </div>





    <footer class="text-center text-white " style="background-color: #2E303C;width:100%;margin-top:32vh;">
       <div class="text-center p-3" style="background-color: #2E303C;">
            © 2021 Copyright:
        <p class="text-white" >Codefactory (classwork-CodeReview)</p>
        </div>
        </footer>
</body>
</html>