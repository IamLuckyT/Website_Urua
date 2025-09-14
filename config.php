<?php
//For allowing a connection between the database and the localhost
$host = "localhost";                                    //For providing access to local host
$user = "root";                                         //Gives access to the root file by allowing user to access root file
$password = "";                                         //Password is blank since its admin who has access
$database = "users_db";                                 //Accesses the users database thats stored on the local host

$conn = new mysql($host, $user,$password, $database);   //Creates a connection to the database

if ($conn->connect_error){                              //Statement tracks if there are any errors found when connecting
    die("connection failed: ". $conn->connect_error);   //if connection fails it kills the process
}

?>