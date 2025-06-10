<?php
//database connection
$conn = mysqli_connect("localhost", "root", "", "webnote");
//database error
if(!$conn){
    echo "problem connecting to database!";
}
require_once 'config.php';

