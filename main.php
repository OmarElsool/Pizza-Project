<?php

include("db_connect.php");

if(isset($_POST['delete'])){

    $delete_id = mysqli_real_escape_string($connact,$_POST['delete_id']);

    $sql = "DELETE FROM `omar pizzas` WHERE id=$delete_id ";

    if(mysqli_query($connact,$sql)){
        // success do nothing
    }else{
        echo "Error " . mysqli_errno($connact); 
    }

};

// Select table from query
$sql = 'SELECT title, ingredients, id FROM `omar pizzas` ORDER BY created_at';

// Make query and get result
$result = mysqli_query($connact, $sql);

// Fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free the data base and close the connect to it
mysqli_free_result($result);

mysqli_close($connact);

?>



<!DOCTYPE html>
<html lang="en">

<?php include("header.php") ?>

<h3 class="center">Pizzas!</h3>
<div class="wrap-flex">
<?php foreach($pizzas as $pizza){  ?>
        <div class="card-container">
                <h5 class="card-body"><?php echo htmlspecialchars($pizza['title']); ?></h5>
            <div class="Pizza-img">
                <img width="150px" height="150px" src="Pizza.jpg"/>
            </div>
            <div class="card-body"><?php echo htmlspecialchars($pizza['ingredients']); ?></div>

            <!-- split the ingredients -->
            <!-- <ul>
                <?php foreach(explode(',',$pizza['ingredients']) as $ing ) { ?>
                    <li><?php echo htmlspecialchars($ing);?></li>
                <?php } ?>
            </ul> -->


            <div class="Info">
                <a href="moreInfo.php?id=<?php echo $pizza['id']; ?>" class="More-info">More Info</a>
                <!-- PHP_SELF == main.php  -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $pizza['id'] ?>">
                    <input type="submit" name="delete" class="btn" value="Delete" >
                </form>
            </div>
        </div>
    <?php } ?>
</div>
        
<?php include("footer.php") ?>

</html>