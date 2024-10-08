<?php
include_once 'database.php';
include_once 'warehouse.php';

$database = new Database();
$db = $database->getConnection();
$warehouse = new Warehouse($db);

$warehouse->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$stmt = $warehouse->read();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_POST) {
    $warehouse->name = $_POST['name'];
    $warehouse->location = $_POST['location'];
    $warehouse->capacity = $_POST['capacity'];
    $warehouse->opening_hour = $_POST['opening_hour'];
    $warehouse->closing_hour = $_POST['closing_hour'];
    $warehouse->status = $_POST['status'];

    if ($warehouse->update()) {
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger'>Tidak dapat mengupdate gudang.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gudang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Gudang</h2>
    <form action="edit.php?id=<?php echo $warehouse->id; ?>" method="POST">
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="location">Lokasi:</label>
            <input type="text" class="form-control" name="location" value="<?php echo $row['location']; ?>" required>
        </div>
        <div class="form-group">
            <label for="capacity">Kapasitas:</label>
            <input type="number" class="form-control" name="capacity" value="<?php echo $row['capacity']; ?>" required>
        </div>
        <div class="form-group">
            <label for="opening_hour">Jam Buka:</label>
            <input type="time" class="form-control" name="opening_hour" value="<?php echo $row['opening_hour']; ?>" required>
        </div>
        <div class="form-group">
            <label for="closing_hour">Jam Tutup:</label>
            <input type="time" class="form-control" name="closing_hour" value="<?php echo $row['closing_hour']; ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" name="status">
                <option value="aktif" <?php echo ($row['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                <option value="tidak_aktif" <?php echo ($row['status'] == 'tidak_aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
