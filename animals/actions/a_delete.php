<?php 
session_start();
require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';



if (!isset($_SESSION['adm'])) {
    header("Location: ../index.php");
    exit;
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM animals WHERE id = {$id}";
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "Successfully Deleted!";
    } else {
        $class = "danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
    }
    mysqli_close($connect);
} 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete</title>
        <?php require_once '../../components/boot.php'?>  
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Delete request response</h1>
            </div>
            <div class="alert alert-<?=$class;?>" role="alert">
                <p><?=$message;?></p>
                <a href='../../dashBoard.php'><button class="btn btn-success" type='button'>back</button></a>
            </div>
        </div>
    </body>
</html>