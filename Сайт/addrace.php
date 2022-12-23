<?php
$racing_center = new PDO('mysql:host=localhost;dbname=racingcenter', 'root');

$sql = 'INSERT INTO Race(RaceName, RaceInfo) VALUES (:name, :info)';
$query = $racing_center->prepare($sql);
$query->execute(['name' => $_POST['r_name'], 'info' => nl2br($_POST['info'])]);

header('Location: /');
?>