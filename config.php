<?php

define('DB_SERVER', '*');
define('DB_USERNAME', '*');
define('DB_PASSWORD', '*');
define('DB_NAME', '*');
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link == false) {

    die("ERROR: Could not connect to database." . mysqli_connect_error());
}

?>