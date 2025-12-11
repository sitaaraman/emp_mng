<?php include '../config/db.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>State List</title>
</head>

<body class="p-4">

<!-- Navigation buttons -->
<div class="mb-3">
    <a href="../emp/index.php" class="btn btn-primary me-2">Manage Employees</a>
    <a href="../country/index.php" class="btn btn-success me-2">Manage Countries</a>
    <a href="create.php" class="btn btn-warning">Add State</a>
</div>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>State</th>
        <th>Country</th>
        <th>Action</th>
    </tr>
    <?php 
    $q = $conn->query("SELECT s.*, c.country_name FROM state s LEFT JOIN country c ON s.country_id=c.id");
    while ($r = $q->fetch_assoc()): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= $r['statename'] ?></td>
            <td><?= $r['country_name'] ?></td>
            <td>
                <a href="edit.php?id=<?= $r['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete.php?id=<?= $r['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
