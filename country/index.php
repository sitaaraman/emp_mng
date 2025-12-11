<?php include '../config/db.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Country List</title>
</head>

<body class="p-4">

    <!-- Navigation buttons -->
    <div class="mb-3">
        <a href="../emp/index.php" class="btn btn-primary me-2">Manage Employees</a>
        <a href="../state/index.php" class="btn btn-warning me-2">Manage States</a>
        <a href="create.php" class="btn btn-success">Add Country</a>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Country</th>
            <th>Action</th>
        </tr>
        <?php
        $q = $conn->query('SELECT * FROM country');
        while ($r = $q->fetch_assoc()): ?>
            <tr>
                <td><?= $r['id'] ?></td>
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