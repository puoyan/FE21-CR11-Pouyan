<?php
session_start(); // start a new session or continues the previous

if (isset($_SESSION['user']) != "") {
    header("Location: home.php"); // redirects to home.php
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to home.php
}
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';
$error = false;
$first_name = $last_name = $password = $email = $address = $phone_number = $picture = '';
$first_nameError = $last_nameError = $passwordError = $emailError = $addressErorr = $phone_namberErorr = $picError = '';
if (isset($_POST['btn-signup'])) {

    // sanitize user input to prevent sql injection
    $first_name = trim($_POST['first_name']);

    //trim - strips whitespace (or other characters) from the beginning and end of a string
    $first_name = strip_tags($first_name);

    // strip_tags -- strips HTML and PHP tags from a string

    $first_name = htmlspecialchars($first_name);
    // htmlspecialchars converts special characters to HTML entities
    
    $last_name = trim($_POST['last_name']);
    $last_name = strip_tags($last_name);
    $last_name = htmlspecialchars($last_name);    

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $address = trim($_POST['address']);
    $phone_number = trim($_POST['phone_number']);

    $password = trim($_POST['password']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

    $uploadError = '';
    $picture = '';

    if(isset($_FILES['picture']))
    {
        $picture = file_upload($_FILES['picture'],'user');
    }


    // basic name validation
    if (empty($first_name) || empty($last_name)) {
        $error = true;
        $first_nameError = "Please enter your full name and surname";
    } else if (strlen($first_name) < 3 || strlen($last_name) < 3) {
        $error = true;
        $first_nameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $first_name) || !preg_match("/^[a-zA-Z]+$/", $last_name)) {
        $error = true;
        $first_nameError = "Name and surname must contain only letters and no spaces.";
    }
   
    //basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
    // checks whether the email exists or not
        $query = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    //checks if the date input was left empty
    // if (empty($date_of_birth)) {
    //     $error = true;
    //     $dateError = "Please enter your date of birth.";
    // }
    // passwordword validation
    if (empty($password)) {
        $error = true;
        $passwordError = "Please enter password.";
    } else if (strlen($password) < 6) {
        $error = true;
        $passwordError = "password must have at least 6 characters.";
    }

    // passwordword hashing for security
    $password = hash('sha256', $password);
    // if there's no error, continue to signup
    if (!$error) {

        $query = "INSERT INTO user(first_name, last_name, password,  email, address , phone_number ,picture)
                  VALUES('$first_name', '$last_name', '$password','$email', '$address','$phone_number','$picture->fileName')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';

        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
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
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #45637d !important;">
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


<div class="container mt-5">
   <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
            <h2>Sign Up.</h2>
            <hr/>
            <?php
            if (isset($errMSG)) {
            ?>
            <div class="alert alert-<?php echo $errTyp ?>" >
                         <p><?php echo $errMSG; ?></p>
                         <p><?php echo $uploadError; ?></p>
            </div>

            <?php
            }
            ?>
             <div class="container" >

             <input type ="text"  name="first_name"  class="form-control"  placeholder="First Name" maxlength="50" value="<?php echo $first_name ?>"  />
               <span class="text-danger"> <?php echo $first_nameError; ?> </span>

            <input type ="text"  name="last_name"  class="form-control"  placeholder="Last Name" maxlength="50" value="<?php echo $last_name ?>"  />
               <span class="text-danger"> <?php echo $first_nameError; ?> </span>

            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value ="<?php echo $email ?>"  />
               <span  class="text-danger"> <?php echo $emailError; ?> </span>

               <input type="password" name="password" class="form-control" placeholder="Enter password" maxlength="15"  />
               <span class="text-danger"> <?php echo $passwordError; ?> </span>
             
                <input class='form-control' type="file" name="picture" >
                <span class="text-danger"> <?php echo $picError; ?> </span>

                <input type ="text"  name="address"  class="form-control"  placeholder="Address" maxlength="50" value="<?php echo $address ?>"  />
               <span class="text-danger"> <?php echo $addressError; ?> </span>

               <input type ="number"  name="phone_number"  class="form-control"  placeholder="Phone Number" maxlength="50" value="<?php echo $phone_number ?>"  />
               <span class="text-danger"> <?php echo $phone_numberError; ?> </span>
            
            
            <hr/>
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            <hr/>
            <a href="index.php">Sign in Here...</a>
   </form>
   </div>



             </div>



             <footer class="text-center text-white mt-5" style="background-color: #45637d;width:100%">
       <div class="text-center p-3" style="background-color: #45637d;">
            © 2021 Copyright:
        <p class="text-white" >Codefactory (classwork-CodeReview)</p>
        </div>
        </footer>
           
</body>
</html>