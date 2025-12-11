<?php include '../config/db.php';
$id = "";
$st = ["statename" => "", "country_id" => ""];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $st = $conn->query("SELECT * FROM state WHERE id=$id")->fetch_assoc();
}
if (isset($_POST['save'])) {
    $name = $_POST['statename'];
    $co = $_POST['country_id'];
    if ($_POST['id'] == "") {
        $conn->query("INSERT INTO state(statename,country_id) VALUES('$name','$co')");
    } else {
        $conn->query("UPDATE state SET statename='$name',country_id='$co' WHERE id=$id");
    }
    header('Location: index.php');
    exit;
}
$country = $conn->query("SELECT * FROM country"); ?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <form method="post" class="card p-3">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input class="form-control mb-2" name="statename" placeholder="State Name" value="<?= $st['statename'] ?>">
        <select name="country_id" class="form-select mb-3">
            <?php while ($c = $country->fetch_assoc()): ?>
                <option value="<?= $c['id'] ?>" <?= ($c['id'] == $st['country_id']) ? 'selected' : '' ?>><?= $c['country_name'] ?></option>
            <?php endwhile; ?>
        </select>
        <button class="btn btn-primary" name="save">Save</button>
    </form>
</body>

</html>