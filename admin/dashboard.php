<?php
// dashboard.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require_once 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin-styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <a href="logout.php" class="btn">Logout</a>
        
        <div id="package-form">
            <h2>Add/Edit Package</h2>
            <form action="save_package.php" method="post">
                <input type="hidden" name="id" id="package-id">
                <input type="text" name="title" id="package-title" placeholder="Title" required>
                <textarea name="description" id="package-description" placeholder="Description" required></textarea>
                <input type="text" name="image" id="package-image" placeholder="Image URL" required>
                <input type="text" name="country" id="package-country" placeholder="Country" required>
                <input type="text" name="program_type" id="package-program-type" placeholder="Program Type" required>
                <input type="text" name="field_of_study" id="package-field-of-study" placeholder="Field of Study" required>
                <input type="text" name="education_level" id="package-education-level" placeholder="Education Level" required>
                <input type="text" name="duration" id="package-duration" placeholder="Duration" required>
                <input type="text" name="price" id="package-price" placeholder="Price" required>
                <button type="submit">Save Package</button>
            </form>
        </div>

        <div id="package-list">
            <h2>Existing Packages</h2>
            <table id="packages-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Country</th>
                        <th>Program Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT id, title, country, program_type FROM packages");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['country']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['program_type']) . "</td>";
                        echo "<td>";
                        echo "<a href='edit_package.php?id=" . $row['id'] . "' class='btn edit-btn'>Edit</a>";
                        echo "<a href='delete_package.php?id=" . $row['id'] . "' class='btn delete-btn' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>