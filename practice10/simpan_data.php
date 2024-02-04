<?php
include "koneksi.php";
include "create_message.php";

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["gambar"]["name"]);
$error = false;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$old_file = $_POST['old_file'];

// Function to delete a file
function deleteFile($file)
{
    if (file_exists($file)) {
        unlink($file);
    }
}

// Inisialisasi pesan-pesan kesalahan
$fileExistsMessage = "";
$fileSizeMessage = "";
$fileTypeMessage = "";
$errorMessage = "";

// Check if file already exists
if (file_exists($target_file)) {
    $fileExistsMessage = "Sorry, file already exists.";
    $error = true;
}

// Check file size (max 500KB)
if ($_FILES["foto"]["size"] > 500000) {
    $fileSizeMessage = "Sorry, your file is too large.";
    $error = true;
}

// Allow only certain file formats
$allowedFileTypes = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imageFileType, $allowedFileTypes)) {
    $fileTypeMessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $error = true;
}

// Check if any error occurred
if ($error) {
    $errorMessage = "Sorry, your file was not uploaded.";
} else {
    // No error, move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $fileUploadedMessage = "The file " . basename($_FILES["gambar"]["name"]) . " has been uploaded.";

        // Delete the old file if it's not "no_image.jpg"
        if ($old_file !== null && $old_file !== 'uploads/') {
          deleteFile($old_file);
      }
    } else {
        $errorMessage = "Sorry, there was an error uploading your file.";
    }
}

// Set error messages to the session for later display
$_SESSION["fileExistsMessage"] = $fileExistsMessage;
$_SESSION["fileSizeMessage"] = $fileSizeMessage;
$_SESSION["fileTypeMessage"] = $fileTypeMessage;
$_SESSION["errorMessage"] = $errorMessage;

// Insert or update data based on the presence of mahasiswa_id
if (isset($_POST['mahasiswa_id'])) {
    //Kondisi Update
    $sql = "UPDATE mahasiswa SET nama_lengkap = '" . $_POST['nama_lengkap'] . "',alamat = '" . $_POST['alamat'] . "',kelas_id = '" . $_POST['kelas_id'] . "', foto = '" . $target_file . "' WHERE (`mahasiswa_id` = '" . $_POST['mahasiswa_id'] . "');";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        create_message("Ubah Data Berhasil", "success", "check");
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $conn->close();
        create_message("Error: " . $sql . "<br>" . $conn->error, "danger", "warning");
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    //Kondisi Insert
    $sql = "INSERT INTO mahasiswa (nama_lengkap, kelas_id, alamat, foto) VALUES ('" . $_POST['nama_lengkap'] . "', " . $_POST['kelas_id'] . ", '" . $_POST['alamat'] . "', '" . $target_file . "')";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        create_message("Simpan Data Berhasil", "success", "check");
        header("location:index.php");
        exit();
    } else {
        $conn->close();
        create_message("Error: " . $sql . "<br>" . $conn->error, "danger", "warning");
        header("location:index.php");
        exit();
    }
}
?>
