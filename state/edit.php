<?php
include '../config/db.php';
$id = $_GET['id'] ?? 0;
$errors = [];

$state = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM state WHERE id=$id"));
$countries = mysqli_query($conn, "SELECT * FROM country");

if (isset($_POST['update'])) {
    $statename = trim($_POST['statename']);
    $country_id = $_POST['country_id'];

    if (empty($statename)) $errors[] = "State name required";
    if (empty($country_id)) $errors[] = "Select country";

    if (count($errors) == 0) {
        mysqli_query($conn, "UPDATE state SET statename='$statename', country_id='$country_id' WHERE id=$id");
        header('Location: index.php');
    }
}
?>


<!-- HTML FORM -->
<form method="POST">
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul><?php foreach ($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>


    <input type="text" name="statename" value="<?= $state['statename'] ?>" class="form-control mb-2">
    <select name="country_id" class="form-control mb-2">
        <option value="">Select Country</option>
        <?php while ($c = mysqli_fetch_assoc($countries)): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id'] == $state['country_id'] ? 'selected' : '' ?>><?= $c['country_name'] ?></option>
        <?php endwhile; ?>
    </select>
    <button class="btn btn-primary" name="update">Update</button>
</form>