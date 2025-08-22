<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "auonline_merch_db";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
}