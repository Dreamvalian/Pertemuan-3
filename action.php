<?php
    include('server/connection.php');

    $username = $_POST['user_name'];
    $password = $_POST['user_password'];
    $email = $_POST['user_email'];

    $query = "INSERT INTO users VALUES('', '$username', '$email', '$password', '', '', '', '')";

    mysqli_query($conn, $query);

    header("location: register.html");
    ?>