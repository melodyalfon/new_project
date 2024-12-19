<?php
require_once("../database/db.php");

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (!$id) {
  die("Invalid user ID");
}

$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);


$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username =   trim($_POST['username']);
  $fullname = trim($_POST['fullname']);

//   update user data
  $sql = "UPDATE users SET username = '$username', fullname = '$fullname' WHERE id = $id";
  $update_result = mysqli_query($conn, $sql);

  if ($update_result) {
    header('Location: admin.php?success=User+updated+successfully');
    exit;
  } else {
    $error = "Failed to update user data";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <h1>Edit User</h1>

  <?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>

  <form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>">

    <label for="fullname">Full Name:</label>
    <input type="text" name="fullname" id="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>">
    <br>
    <button type="submit">Update</button>
  </form>

</body>
</html>