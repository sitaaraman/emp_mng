<?php include '../config/db.php';
$id = '';
$co = ['country_name' => ''];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $co = $conn->query("SELECT * FROM country WHERE id=$id")->fetch_assoc();
}
if (isset($_POST['save'])) {
    $name = $_POST['country_name'];
    if ($_POST['id'] == '') {
        $conn->query("INSERT INTO country(country_name) VALUES('$name')");
    } else {
        $conn->query("UPDATE country SET country_name='$name' WHERE id=$id");
    }
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <form method="post" class="card p-3">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input class="form-control mb-3" name="country_name" placeholder="Country Name" value="<?= $co['country_name'] ?>">
        <button class="btn btn-primary" name="save">Save</button>
    </form>
</body>

</html>