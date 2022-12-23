<?php
$racing_center = new PDO('mysql:host=localhost;dbname=racingcenter', 'root');

$points = rand(0,200);
$sql = 'INSERT INTO users(LastName, FirstName, MiddleName, Login, Password, StartDate,	Equipment, Points, Disquals, Role) VALUES(:ln, :fn, :mn, :login, :passw, :sdate, :eq, :pts, 0, 0)';
$query = $racing_center->prepare($sql);
$query->execute(['ln' => $_POST['LName'], 'fn' => $_POST['Name'], 'mn' => $_POST['MName'], 'login' => $_POST['Login'], 'passw' => $_POST['Password'], 'sdate' => $_POST['racing_start'], 'eq' => $_POST['Equipment'], 'pts' => $points]);

$get_u_info = 'SELECT id, Role FROM users WHERE Login = :userlogin';
$u_info = $racing_center->prepare($get_u_info);
$u_info->execute(['userlogin' => $_POST['Login']]);
$u_info = $u_info->fetch(PDO::FETCH_OBJ);

setcookie('id', $u_info->id, time() + 3600*24);
setcookie('Role', $u_info->role, time() + 3600*24);
header('Location: /');
?>