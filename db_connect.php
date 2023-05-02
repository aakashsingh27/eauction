<?php

// Connecting to the Database
$servername = "localhost";
$username = "sabredge_jigsaw";
$password = "sabredge_jigsaw";
$db = "sabredge_jigsaw";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
   // echo "Connection was successful";
}

?>
