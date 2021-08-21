<?php
session_start();
require_once 'components/db_connect.php';


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
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
        <?php require_once 'components/boot.php'?>
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
                        <td><?php echo $name ?></td>
                    </tr>   
                    
                    <tr>
                        <th>location</th>
                        <td><?php echo $location ?></td>
                    </tr>   

                    <tr>
                        <th>description</th>
                        <td><?php echo $description ?><td>
                    </tr>   

                    <tr>
                        <th>hobbies</th>
                        <td><?php echo $hobbies ?></td>
                    </tr>
                    
                    <tr>
                        <th>size</th>
                        <td><?php echo $size ?></td>
                    </tr>

                    <tr>
                        <th>age</th>
                        <td><?php echo $age ?></td>
                    </tr>

                    <tr>
                        <th>breed</th>
                        <td><?php echo $breed ?></td>
                    </tr>

                    <tr>
                        <th>picture</th>
                        <td><img  style="width:300px;height:300px;" src="animals/pictures/<?php echo $pic_animal ?>"/></td>
                    </tr>
                 
                    
                    <tr>
                        <?php
                        
                        if($_GET["previouse_page"] == "home")
                        {
                            
                            echo '<td><a href="home.php" name="submit" class="btn btn-dark" type="submit">Back</a></td>';
                        }
                        else{
                            echo '<td><a href="animals/senior.php" name="submit" class="btn btn-dark" type="submit">Back</a></td>';
                        }
                        
                        ?>
                    </tr>
                </table>
            </form>
            </form>
        </fieldset>
    </body>
</html>