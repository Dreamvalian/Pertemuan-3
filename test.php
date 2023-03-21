<?php
session_start();
include('connection.php');
$result = mysqli_query($conn, "SELECT user_name from user");

while ($row = mysqli_fetch_assoc($result)) {
    $user_name = $row['user_name'];
    echo "<div class='test'>Welcome $user_name</div>";
}
?>