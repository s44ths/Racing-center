<?php
$racing_center = new PDO('mysql:host=localhost;dbname=racingcenter', 'root');

$sql = 'DELETE FROM Request WHERE req_id = :req';
$query = $racing_center->prepare($sql);
$query->execute(['req' => $_POST['request_id']]);

header('Location: /my.php');
?>