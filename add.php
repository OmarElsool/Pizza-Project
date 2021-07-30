<?php 
    //connect to data base
    include("db_connect.php");

    $title = $email = $ingredients = '';
    $errors = array('email' => '','title' => '' ,'ingredients' =>'');
    if(isset($_POST['submit'])){

        // Check email
        if(empty($_POST['email'])){
            $errors['email'] = "Email is Required <br />";
        }else{
            $email =  htmlspecialchars( $_POST['email']);
            // filter_var for check if the email is valid
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Email is not valid";
            };
        };
        //Check title
        if(empty($_POST['title'])){
            $errors['title'] = "Title is Required <br />";
        }else{
            $title = htmlspecialchars($_POST['title']);
            //preg_match for Regular Expressions (RegEx) check if it's valid
            if(!preg_match('/^[a-zA-Z\s]+$/' , $title)){
            $errors['title'] = "Title must be only letters and spaces <br />";
            }
        };
        //check ingredients
        if(empty($_POST['ingredients'])){
            $errors['ingredients'] = "one ingredients at least is required <br />";
        }else{
            $ingredients = htmlspecialchars($_POST['ingredients']);
            if(!preg_match('/(^[a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)){
            $errors['ingredients'] = 'ingredients must be a comma separated';
            };
        }

        // if there is no error go to main page 
        if(array_filter($errors)){
			//echo 'errors in form';
		} else {

            //mysqli_real_escape_string is for if someone insert sql command 
            $email = mysqli_real_escape_string($connact,$_POST['email']);
            $title = mysqli_real_escape_string($connact,$_POST['title']);
            $ingredients = mysqli_real_escape_string($connact,$_POST['ingredients']);

            //command to data base to insert new values
            $sql = "INSERT INTO `omar pizzas`(email,title,ingredients) VALUES ('$email','$title','$ingredients')";

            if(mysqli_query($connact,$sql)){
                //echo 'form is valid';
                header('Location: main.php');
            }else{
                //error
                echo "data base error " . mysqli_errno($connact);
            }
			
		}
    }

?> 

<!DOCTYPE html>
<html lang="en">

<?php include("header.php") ?>

<div class="container-box">
    <h1 class="title">Add a Pizza</h1>
    <div class="containerAdd">
        <form method="POST" action=" <?php echo $_SERVER['PHP_SELF']; ?> ">
            <div class="input-box">
                <label class="details">Your Email :</label>
                <input placeholder="Email" type="text" name="email" value="<?php echo $email ?>" >
                <div class="valid"><?php echo $errors['email'] ?></div>
            </div>
            <div class="input-box">
                <label class="details">Pizza Title :</label>
                <input placeholder="Title" type="text" name="title" value="<?php echo $title ?>">
                <div class="valid"><?php echo $errors['title'] ?></div>
            </div>
            <div class="input-box">
                <label class="details">ingredients (comma separate) :</label>
                <input placeholder="ingredients" type="text" name="ingredients" value="<?php echo $ingredients ?>" >
                <div class="valid"><?php echo $errors['ingredients'] ?></div>
            </div>
            <div class="button">
                <input type="submit" name="submit" value="submit" >
            </div>
        </form>
    </div>
</div>

<?php include("footer.php") ?>

</html>