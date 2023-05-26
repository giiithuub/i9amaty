<?php

    $host = "localhost";
    $username = "root";
    $password = "root";
    $database = "i9amati";

    // connection login f database
    $con = mysqli_connect($host,$username,$password, $database);

    // check la cnx
    if(!$con){
        die("Connection failed ". mysqli_connect_error());
    }


?>