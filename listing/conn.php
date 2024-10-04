<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "plant";
if ($conn = mysqli_connect($host, $user, $pass, $db)) {
} else {
    echo "Connection failed";
}
?>