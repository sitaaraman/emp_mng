<?php include '../config/db.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Employee List</title>
</head>

<body class="p-4">

<!-- Buttons to navigate to Country and State pages -->
<div class="mb-3">
    <a href="../country/index.php" class="btn btn-info me-2">Manage Countries</a>
    <a href="../state/index.php" class="btn btn-warning me-2">Manage States</a>
    <a href="create.php" class="btn btn-primary">Add Employee</a>
</div>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>City</th>
        <th>State</th>
        <th>Country</th>
        <th>Action</th>
    </tr>
    <?php
    $q = $conn->query("SELECT e.*, s.statename, c.country_name FROM employee e LEFT JOIN state s ON e.state_id=s.id LEFT JOIN country c ON e.country_id=c.id");
    while ($r = $q->fetch_assoc()): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td>
                <abbr title="<?= $r['address'] . ", ". $r['city']; ?>" style="text-decoration: none;">
                    <?= $r['first_name'] . ' ' . $r['last_name'] ?>
                </abbr>
            </td>
            <td><?= $r['email'] ?></td>
            <td><?= $r['city'] ?></td>
            <td><?= $r['statename'] ?></td>
            <td><?= $r['country_name'] ?></td>
            <td>
                <a href="edit.php?id=<?= $r['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a onclick="return confirm('Delete?')" href="delete.php?id=<?= $r['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
