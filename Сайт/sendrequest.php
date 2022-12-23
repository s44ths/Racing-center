<?php
$racing_center = new PDO('mysql:host=localhost;dbname=racingcenter', 'root');

$sql = 'INSERT INTO Request(Model, Rollcage, Power, BeltType, Tuning, Tire, sender_id, r_id) VALUES (:model, :cage, :power, :belt, :tuning, :tire, :sid, :rid)';
$query = $racing_center->prepare($sql);
$query->execute(['model' => $_POST['model'], 'cage' => $_POST['rollcage'], 'power' => $_POST['power'], 'belt' => $_POST['belt'], 'tuning' => $_POST['tuning'], 'tire' => $_POST['tire'], 'sid' => $_POST['s_id'], 'rid' => $_POST['race_id']]);

header('Location: /my.php');
?>