<?php
include '../config/db.php';
$id = $_GET['id'] ?? 0;
$errors = [];
$country = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM country WHERE id=$id"));


if (isset($_POST['update'])) {
    $country_name = trim($_POST['country_name']);
    if (empty($country_name)) $errors[] = "Country name required";

    if (count($errors) == 0) {
        mysqli_query($conn, "UPDATE country SET country_name='$country_name' WHERE id=$id");
        header('Location: index.php');
    }
}
?>


<form method="POST">
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul><?php foreach ($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>


    <input type="text" name="country_name" value="<?= $country['country_name'] ?>" class="form-control mb-2">
    <button class="btn btn-primary" name="update">Update</button>
</form>