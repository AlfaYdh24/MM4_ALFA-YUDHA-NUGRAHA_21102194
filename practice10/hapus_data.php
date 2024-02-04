<?php
include "koneksi.php";
include "create_message.php";

// Get the file path before deleting the data
$sqlSelect = "SELECT foto FROM mahasiswa WHERE mahasiswa_id=" . $_GET['mahasiswa_id'];
$result = $conn->query($sqlSelect);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $filePath = $row['foto'];

  // Delete the data from the database
  $sqlDelete = "DELETE FROM mahasiswa WHERE mahasiswa_id=" . $_GET['mahasiswa_id'];

  if ($conn->query($sqlDelete) === TRUE) {
    // If the data is deleted successfully, delete the associated image file
    if ($filePath !== null && $filePath !== "uploads/no_image.jpg" && file_exists($filePath)) {
      unlink($filePath);
    }

    $conn->close();
    create_message("Hapus Data Berhasil", "success", "check");
    header("location:index.php");
    exit();
  } else {
    $conn->close();
    create_message("Error: " . $sqlDelete . "<br>" . $conn->error, "danger", "warning");
    header("location:index.php");
    exit();
  }
} else {
  $conn->close();
  create_message("Error: Data not found", "danger", "warning");
  header("location:index.php");
  exit();
}
