<?php
require_once("../database/db.php");

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (!$id) {
  die("Invalid user ID");
}

// delte user
$sql = "DELETE FROM users WHERE id = $id";
$delete_result = mysqli_query($conn, $sql);

if ($delete_result) {
  header('Location: admin.php');
  exit;
} else {
  die("Failed to delete user");
}
?>