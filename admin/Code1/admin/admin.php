<?php
require_once("../database/db.php");

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <!-- navbar -->
    <nav class="navbar">
        <section>
            <a href="home.php">Home</a>
            <a href="add_user.php">Add User</a>
            <a href="../handler/logout.php" style="float: right">Logout</a>
        </section>
    </nav>

    <!-- table -->
    <table border="1" cellspacing="0" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Fullname</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row["id"]); ?></td>
            <td><?php echo htmlspecialchars($row["username"]); ?></td>
            <td><?php echo htmlspecialchars($row["fullname"]); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" style="display: inline-block; padding: 8px 12px; background-color: #007bff; color: #fff; border: 1px solid #007bff; border-radius: 5px; text-decoration: none; transition: background-color 0.3s, color 0.3s;">
                    Edit
                </a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="confirmDelete(event)" style="display: inline-block; padding: 8px 12px; background-color: #dc3545; color: #fff; border: 1px solid #dc3545; border-radius: 5px; text-decoration: none; transition: background-color 0.3s, color 0.3s;">
                    Delete
                </a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

    <script>
        function confirmDelete(event) {
            event.preventDefault();

            if (confirm('Are you sure you want to delete this account?')) {
                window.location.href = event.target.href;
            }
        }
    </script>
</body>
</html>
