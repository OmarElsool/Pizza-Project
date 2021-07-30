<?php

    include("db_connect.php");


    //check if id is set
    if(isset($_GET['id'])){
        // escape sql chars
        $id = mysqli_real_escape_string($connact,$_GET['id']);

        //sql command to select all info depend on id 
        $sql = "SELECT * FROM `omar pizzas` WHERE id=$id";

        //GET the result from data base
        $result = mysqli_query($connact,$sql);

        // fetch the data into array form
        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($connact);
    }

?>

<!DOCTYPE html>
<html lang="en">

<?php include("header.php") ?>

<div class="con-MoreInfo">
    <?php if($pizza): ?>
    <h2><?php echo $pizza['email']; ?></h2>
    <h2><?php echo $pizza['title']; ?></h2>
    <h2><?php echo date($pizza['Created_at']); ?></h2>
    <h1>Ingredients :</h1>
    <h2><?php echo$pizza['ingredients']; ?></h2>
    <?php else: ?>
    <h1>There is no pizza</h1>
    <?php endif ?>

    
</div>

<?php include("footer.php") ?>


</html>