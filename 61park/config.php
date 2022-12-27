<?php

define('DB_SERVER', 'xxx');
define('DB_USERNAME', 'xxx');
define('DB_PASSWORD', 'xxx');
define('DB_NAME', '61park');
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link == false) {

    die("ERROR: Could not connect to database." . mysqli_connect_error());
}

?>
