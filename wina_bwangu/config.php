<?php
// db_connection.php
$host = 'localhost';
$db = 'wina_bwangu'; // Your database name
$user = 'root'; // Default XAMPP user
$pass = ''; // Leave empty for default XAMPP installations

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
