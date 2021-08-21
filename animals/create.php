<?php
session_start();
require_once '../components/db_connect.php';



if (!isset($_SESSION['adm'])) {
    header("Location: ../index.php");
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../components/boot.php'?>
        <title>PHP CRUD  |  Add animal</title>
        <style>
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }       
        </style>
    </head>
    <body>
        <fieldset>
            <legend class='h2'>Add animal</legend>
            <form action="actions/a_create.php" method= "post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="name"  placeholder="animal Name" /></td>
                    </tr>   
                    
                    <tr>
                        <th>location</th>
                        <td><input class='form-control' type="text" name="location"  placeholder="location" /></td>
                    </tr>   

                    <tr>
                        <th>description</th>
                        <td><input class='form-control' type="text" name="description"  placeholder="description" /></td>
                    </tr>   

                    <tr>
                        <th>hobbies</th>
                        <td><input class='form-control' type="text" name="hobbies"  placeholder="hobbies" /></td>
                    </tr>
                    
                    <tr>
                        <th>size</th>
                        <td><input class='form-control' type="text" name="size"  placeholder="size" /></td>
                    </tr>

                    <tr>
                        <th>age</th>
                        <td><input class='form-control' type="number" name="age"  placeholder="age" /></td>
                    </tr>

                    <tr>
                        <th>breed</th>
                        <td><input class='form-control' type="text" name="breed"  placeholder="sbreedize" /></td>
                    </tr>

                    <tr>
                        <th>picture</th>
                        <td><input class='form-control' type="text" name="pic_animal"  placeholder="folder address" /></td>
                    </tr>
                 
                    
                    <tr>
                        <td><button name="submit" class='btn btn-success' type="submit">Insert animal</button></td>
                        <td><a href="../dashBoard.php"><button class='btn btn-warning' type="button">Back</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>
</html>