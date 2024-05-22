<?php
$host = 'localhost';
$dbname = 'sms_viewer1';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$stmt = $pdo->prepare('SELECT * FROM Users');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display the results
foreach ($users as $user) {
    echo $user['name'] . ' (' . $user['email'] . ')' . PHP_EOL;
}
?>
