<?php
$racing_center = new PDO('mysql:host=localhost;dbname=racingcenter', 'root');

$points = rand(0,200);
$sql = 'UPDATE users SET LastName = :ln, FirstName = :fn, MiddleName = :mn, Login = :login, Password = :passw, Equipment = :eq WHERE id = :userid';
$query = $racing_center->prepare($sql);
$query->execute(['ln' => $_POST['LName'], 'fn' => $_POST['Name'], 'mn' => $_POST['MName'], 'login' => $_POST['Login'], 'passw' => $_POST['Password'], 'eq' => $_POST['Equipment'], 'userid' => $_POST['uid']]);

header('Location: /userinfo.php');
?>