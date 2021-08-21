<?php
session_start();
require_once '../components/db_connect.php';


if (!isset($_SESSION['adm'])) {
    header("Location: ../index.php");
    exit;
}



//fetch and populate form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data['name'];
        $location = $data['location'];
        $description = $data['description'];
        $hobbies = $data['hobbies'];
        $size = $data['size'];
        $age = $data['age'];
        $breed = $data['breed'];
        $pic_animal = $data['pic_animal'];
    }   
}

mysqli_close($connect);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Animal</title>
        <?php require_once '../components/boot.php'?>
        <style type= "text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }  
            .img-thumbnail{
                width: 70px !important;
                height: 70px !important;
            }     
        </style>
    </head>
    <body>
        <fieldset>
           
            <form action="actions/a_update.php?id=<?php echo $id ?>" method= "post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="name"  placeholder="animal Name" value="<?php echo $name ?>" /></td>
                    </tr>   
                    
                    <tr>
                        <th>location</th>
                        <td><input class='form-control' type="text" name="location"  placeholder="location" value="<?php echo $location ?>"/></td>
                    </tr>   

                    <tr>
                        <th>description</th>
                        <td><input class='form-control' type="text" name="description"  placeholder="description" value="<?php echo $description ?>" /></td>
                    </tr>   

                    <tr>
                        <th>hobbies</th>
                        <td><input class='form-control' type="text" name="hobbies"  placeholder="hobbies" value="<?php echo $hobbies ?>"/></td>
                    </tr>
                    
                    <tr>
                        <th>size</th>
                        <td><input class='form-control' type="text" name="size"  placeholder="size" value="<?php echo $size ?>"/></td>
                    </tr>

                    <tr>
                        <th>age</th>
                        <td><input class='form-control' type="number" name="age"  placeholder="age" value="<?php echo $age ?>"/></td>
                    </tr>

                    <tr>
                        <th>breed</th>
                        <td><input class='form-control' type="text" name="breed"  placeholder="breed"  value="<?php echo $breed ?>"/></td>
                    </tr>

                    <tr>
                        <th>picture</th>
                        <td><input class='form-control' type="text" name="pic_animal"  placeholder="folder address"  value="<?php echo $pic_animal ?>"/></td>
                    </tr>
                 
                    
                    <tr>
                        <td><button name="submit" class='btn btn-success' type="submit">update animal</button></td>
                    </tr>
                </table>
            </form>
            </form>
        </fieldset>
    </body>
</html>