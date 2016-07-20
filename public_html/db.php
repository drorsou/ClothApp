<?php

function connectToDb() {
    $dbserver = "localhost";
    $dbusername = "xxxxx";
    $dbname = "xxxxx";
    $dbpassword = "xxxxx";
    mysql_connect($dbserver, $dbusername, $dbpassword) or die(mysql_error());
    mysql_select_db($dbname)or die(mysql_error());
}

?>