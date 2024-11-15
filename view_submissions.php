



<?php
// session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header("Location: login.php");
//     exit;
// }

require_once 'Database.php';

$database = new Database();
$db = $database->getConnection();
$query = "SELECT * FROM submissions";
$stmt = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Logout</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <ul class="navbar">
        <li><a href="home.php">Home</a></li>
        <li><a href="view_submissions.php">Submissions</a></li>


        <!-- Logout button -->
        <li style="float: right;">
            <form method="POST" action="logout.php">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </li>
    </ul>


    <table>
    <tr>
        <th>Sr No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Message</th>
        <th>Image</th>
    </tr>
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?= $row['user_id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['mobile']; ?></td>
            <td><?= $row['message']; ?></td>
            <td><img src="<?= $row['image_path']; ?>" width="100" /></td>
        </tr>
    <?php } ?>
</table>


</body>
</html>









