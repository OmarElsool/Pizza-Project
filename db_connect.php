<?php 

//connect to data base
$connact = mysqli_connect('localhost','Omar','Ichigo010000','omar pizzas');

if(!$connact){
    echo 'connaction error ' . mysqli_connect_error() ;
}

?>