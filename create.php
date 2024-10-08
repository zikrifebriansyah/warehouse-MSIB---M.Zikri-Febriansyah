<?php
include_once 'database.php';
include_once 'warehouse.php';

$database = new Database();
$db = $database->getConnection();
$warehouse = new Warehouse($db);

if ($_POST) {
    $warehouse->name = $_POST['name'];
    $warehouse->location = $_POST['location'];
    $warehouse->capacity = $_POST['capacity'];
    $warehouse->opening_hour = $_POST['opening_hour'];
    $warehouse->closing_hour = $_POST['closing_hour'];

    if ($warehouse->create()) {
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger'>Tidak dapat menambahkan gudang.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gudang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Gudang</h2>
    <form action="create.php" method="POST">
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="location">Lokasi:</label>
            <input type="text" class="form-control" name="location" required>
        </div>
        <div class="form-group">
            <label for="capacity">Kapasitas:</label>
            <input type="number" class="form-control" name="capacity" required>
        </div>
        <div class="form-group">
            <label for="opening_hour">Jam Buka:</label>
            <input type="time" class="form-control" name="opening_hour" required>
        </div>
        <div class="form-group">
            <label for="closing_hour">Jam Tutup:</label>
            <input type="time" class="form-control" name="closing_hour" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
