<?php
session_start();
include('server/connection.php');

if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $q = "SELECT * FROM users WHERE user_id LIKE '%$keyword%' or user_name
    LIKE '%$keyword%' or user_email LIKE '%$keyword%' ";
} else {
    $q = 'SELECT FROM users';
}
$result = mysqli_query($conn, $q);

if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

$result = mysqli_query($conn, "SELECT user_name,user_id,user_email, user_address, user_phone,
user_city,  user_photo from users");

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        header('location: login.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="styles/welcomes.css">
    <title>Document</title>
</head>

<body>

    <!----Content------>
    <div class="container mt-4">
        <form action="" method="post">
            <div class="input-group mb-3">
                <input type="text" name="keyword" class="form-control" placeholder="Masukkan Keyword">
                <button type="submit" class="btn btn-primary" name="cari">Cari</button>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['user_id'] ?></td>
                        <td><?php echo $row['user_name'] ?></td>
                        <td><?php echo $row['user_email'] ?></td>
                        <td>
                            <a href="actionEdit.php?user_id=<?php echo $row['user_id']; ?>" role="button" class="btn btn-warning btn-sm">Edit</a>
                            <a href="actionDelete.php?user_id=<?php echo $row['user_id']; ?>" role="button" class="btn btn-danger btn-sm" onclick="return confirm('Data ini akan dihapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="welcome.php?logout=1" id="logout-btn" class="btn btn-danger">LOG OUT</a>
    </div>

</body>

</html>