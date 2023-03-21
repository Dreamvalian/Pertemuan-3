<?php
include('server/connection.php');

// Check if form has been submitted
if (count($_POST) > 0) {
    mysqli_query($conn, "UPDATE users SET user_name='" . $_POST['user_name'] . "', user_email='" .
        $_POST['user_email'] . "' WHERE user_id='" .
        $_POST['user_id'] . "'");
    $message = "<p style='color:#3E5C99; display: flex; justify-content: center; align-item: center;'> Record Modified Successfully!</p>";
}

// Retrieve user data
$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id='" . $_GET['user_id'] . "'");
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="styles/edit.css">
    <title>Update User Data</title>
</head>

<body>
    <header>
        <nav>
            <a href="welcome.php"> <- User List</a>
        </nav>
    </header>

    <main class="container">
        <div class="row">
            <div class="form-check">
                <h6>Update User Data</h6>

                <?php if (isset($message)) : ?>
                    <div><?php echo $message; ?></div>
                <?php endif; ?>

                <form name="frmUsers" method="post" action="">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">

                    <div>
                        <label for="user_name">User Name:</label>
                        <input type="text" name="user_name" id="user_name" value="<?php echo $row['user_name']; ?>">
                    </div>

                    <div>
                        <label for="user_email">User Email:</label>
                        <input type="text" name="user_email" id="user_email" value="<?php echo $row['user_email']; ?>">
                    </div>

                    <button type="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>