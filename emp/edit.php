<?php
include '../config/db.php';

// Get employee ID
$id = $_GET['id'] ?? 0;

// Initialize employee array
$emp = [
    "first_name" => "",
    "last_name" => "",
    "email" => "",
    "salary" => "",
    "address" => "",
    "city" => "",
    "state_id" => "",
    "country_id" => ""
];

// Load employee data from DB only if not a POST (initial load)
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $id) {
    $emp = $conn->query("SELECT * FROM employee WHERE id=$id")->fetch_assoc();
}

// Preserve submitted values when form reloads (country change)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp['first_name']  = $_POST['first_name'] ?? "";
    $emp['last_name']   = $_POST['last_name'] ?? "";
    $emp['email']       = $_POST['email'] ?? "";
    $emp['salary']      = $_POST['salary'] ?? "";
    $emp['address']     = $_POST['address'] ?? "";
    $emp['city']        = $_POST['city'] ?? "";
    $emp['state_id']    = $_POST['state_id'] ?? "";
    $emp['country_id']  = $_POST['country_id'] ?? "";
}

// Selected country for filtering states
$selected_country = $emp['country_id'];

// Load states for the selected country
$state_list = $selected_country ?
    $conn->query("SELECT * FROM state WHERE country_id=$selected_country") :
    $conn->query("SELECT * FROM state");

// Load all countries
$country_list = $conn->query("SELECT * FROM country");

// Save/update employee
if (isset($_POST['update'])) {
    $fn = $emp['first_name'];
    $ln = $emp['last_name'];
    $eml = $emp['email'];
    $sa = $emp['salary'];
    $ad = $emp['address'];
    $ci = $emp['city'];
    $st = $emp['state_id'];
    $co = $emp['country_id'];

    $conn->query("UPDATE employee SET first_name='$fn', last_name='$ln', email='$eml', salary='$sa', address='$ad', city='$ci', state_id='$st', country_id='$co' WHERE id=$id");
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Employee</title>
</head>

<body class="p-4">

    <a href="index.php" class="btn btn-secondary mb-3">Back</a>

    <form method="post" class="card p-3">

        <input type="hidden" name="id" value="<?= $id ?>">

        <input class="form-control mb-2" name="first_name" placeholder="First Name" value="<?= htmlspecialchars($emp['first_name']) ?>">
        <input class="form-control mb-2" name="last_name" placeholder="Last Name" value="<?= htmlspecialchars($emp['last_name']) ?>">
        <input class="form-control mb-2" name="email" placeholder="Email" value="<?= htmlspecialchars($emp['email']) ?>">
        <input class="form-control mb-2" name="salary" placeholder="Salary" value="<?= htmlspecialchars($emp['salary']) ?>">
        <textarea class="form-control mb-2" name="address" placeholder="Address"><?= htmlspecialchars($emp['address']) ?></textarea>
        <input class="form-control mb-2" name="city" placeholder="City" value="<?= htmlspecialchars($emp['city']) ?>">

        <!-- Country Dropdown -->
        <select name="country_id" class="form-select mb-2" onchange="this.form.submit()">
            <option value="">Select Country</option>
            <?php while ($c = $country_list->fetch_assoc()): ?>
                <option value="<?= $c['id'] ?>" <?= ($c['id'] == $selected_country) ? 'selected' : '' ?>>
                    <?= $c['country_name'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <!-- State Dropdown -->
        <select name="state_id" class="form-select mb-3">
            <option value="">Select State</option>
            <?php while ($s = $state_list->fetch_assoc()): ?>
                <option value="<?= $s['id'] ?>" <?= ($s['id'] == $emp['state_id']) ? 'selected' : '' ?>>
                    <?= $s['statename'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button class="btn btn-primary" name="update">Update</button>
    </form>

</body>

</html>