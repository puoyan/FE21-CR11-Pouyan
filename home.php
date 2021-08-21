<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}



$sql = "SELECT * FROM animals";
$result = mysqli_query($connect, $sql);

//this variable will hold the body for the table
$tbody = ''; 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='animals/pictures/" . $row['pic_animal'] . "' alt=" . $row['pic_animal'] . "></td>
            <td>" . $row['name']."</td>
            <td>" . $row['location'] . "</td>
            <td>" . $row['age'] . "</td>
            <td>" . $row['breed'] . "</td>
           <td> <a  href='info.php?id=" . $row['id'] . "&previouse_page=home'><button class='btn btn-info btn-sm' type='button'>show</button></a></td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm-DashBoard</title>
    <?php require_once 'components/boot.php'?>
    <style type="text/css">  
          
        .img-thumbnail{
            width: 70px !important;
            height: 70px !important;
        }
        td
        {
            text-align: left;
            vertical-align: middle;
        }
        tr
        {
            text-align: center;
        }
        .userImage{
width: 80px;
height: auto;
}
    </style>
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
    <div class="row">
        <div class="col-2">
        <img class="userImage" src="pictures/avatar.png" alt="Adm avatar">
        <p class="">user</p>
        <a href="animals/senior.php">senior animal</a>
        <br/>
        <a href="logout.php?logout">Sign Out</a>
        </div>
        <div class="col-8 mt-2">
        <p class='h2'>Animals</p>
        <table class='table table-striped text-center'>
            <thead class='table-success'>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>location</th>
                    <th>age</th>
                    <th>breed</th>
                    <th>operation</th>
                </tr>
            </thead>
            <tbody>
            <?=$tbody?>
            </tbody>
        </table>
        </div>
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