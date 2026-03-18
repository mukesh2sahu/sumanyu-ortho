<?php
require_once 'db_connect.php';

echo "<h2>Database Setup</h2>";

$sql = file_get_contents('database.sql');

if ($conn->multi_query($sql)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
    echo "<p style='color: green;'>Tables created and default doctor inserted successfully!</p>";
    echo "<p><a href='index.php'>Go to Home Page</a></p>";
} else {
    echo "<p style='color: red;'>Error creating tables: " . $conn->error . "</p>";
}
?>
