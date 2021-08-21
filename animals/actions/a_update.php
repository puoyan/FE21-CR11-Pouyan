<?php
session_start();
require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';



if (!isset($_SESSION['adm'])) {
    header("Location: ../index.php");
    exit;
}



if ($_POST) {    
    $id = $_GET['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $hobbies = $_POST['hobbies'];
    $size = $_POST['size'];
    $age = $_POST['age'];
    $breed = $_POST['breed'];
    $pic_animal = $_POST['pic_animal'];
    $uploadError = '';

    //$picture = file_upload($_FILES['picture']);//file_upload() called  
   

    $sql = "UPDATE animals SET name = '$name', location = '$location', description = '$description', hobbies = '$hobbies' ,size='$size', age= $age, breed= '$breed',pic_animal = '$pic_animal'  WHERE id = {$id}";
    

    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    }
    mysqli_close($connect);    
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Update</title>
        <?php require_once '../../components/boot.php'?> 
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Update request response</h1>
            </div>
            <div class="alert alert-<?php echo $class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../../dashBoard.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
                
            </div>
        </div>
    </body>
</html>