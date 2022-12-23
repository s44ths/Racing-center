<?php
$racing_center = new PDO('mysql:host=localhost;dbname=racingcenter', 'root');

$sql = 'INSERT INTO t_verdict(req_id, tech_id, TOResult, CarType) VALUES (:req, :tech, :tores, :car)';
$query = $racing_center->prepare($sql);
$query->execute(['req' => $_POST['request_id'], 'tech' => $_POST['tech'], 'tores' => $_POST['to'], 'car' => $_POST['cartype']]);

header('Location: /workspace.php');
?>