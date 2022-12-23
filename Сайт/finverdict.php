<?php
$racing_center = new PDO('mysql:host=localhost;dbname=racingcenter', 'root');

$sql = 'INSERT INTO fin_verdict(req_id, s_id, Verdict) VALUES (:req, :sec, :v)';
$query = $racing_center->prepare($sql);
$query->execute(['req' => $_POST['request_id'], 'sec' => $_POST['secr'], 'v' => $_POST['verdict']]);

header('Location: /workspace.php');
?>