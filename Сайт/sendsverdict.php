<?php
$racing_center = new PDO('mysql:host=localhost;dbname=racingcenter', 'root');

$sql = 'INSERT INTO s_verdict(req_id, sec_id) VALUES (:req, :sec)';
$query = $racing_center->prepare($sql);
$query->execute(['req' => $_POST['request_id'], 'sec' => $_POST['secr']]);

header('Location: /workspace.php');
?>