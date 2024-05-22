<?php
session_start();
require_once 'db.php';
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT SMS.*, Channel.name AS channel_name, Field.name AS field_name FROM SMS JOIN Channel ON SMS.channel_id = Channel.id JOIN Field_Channel ON Channel.id = Field_Channel.channel_id JOIN Field ON Field_Channel.field_id = Field.id WHERE SMS.user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$messages = $stmt->fetchAll();
$stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <title>SMS Viewer</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>SMS Viewer</h1>
    <table>
        <thead>
            <tr>
                <th>Channel</th>
                <th>Field</th>
               <th>Description</th>
                <th>Data</th>
            </tr>
        </thead>
        <p>'SMS', 'Notification', 'New update available', 'Visit our website to download the latest update!'</p>
        

        <tbody>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <td><?= $message['channel_name'] ?></td>
                    <td><?= $message['field_name'] ?></td>
                    <td><?= $message['description'] ?></td>
                    <td><?= $message['data'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php">Logout</a>
</body>
</html>
